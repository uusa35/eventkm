<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Survey;
use App\Models\User;
use App\Services\Traits\OrderTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Usama\Tap\Controllers\TapTrait;

class SurveyController extends Controller
{
    use TapTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|max:200',
            'email' => 'email|nullable',
            'mobile' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput(request()->all());
        }
        try {
            $survey = Survey::whereId($request->survey_id)->first();
            $questionnaire = Questionnaire::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'notes' => $request->notes,
                'price' => $survey->price,
                'net_price' => $survey->finalPrice,
                'is_order' => $survey->is_order,
                'survey_id' => $survey->id,
                'user_id' => $request->user_id,
                'client_id' => auth()->id()
            ]);
            if ($questionnaire) {
                foreach ($request->question_id as $questionId => $value) {
                    $question = Question::whereId($questionId)->first();
                    if ($question) {
                        $answer = $question->is_multi || $question->is_dropdown ? Answer::where(['value' => $request->question_id[$question->id]])->first() : null;
                        $questionnaire->results()->create([
                            'question_id' => $question->id,
                            'answer_id' => $answer ? $answer->id : null,
                            'questioned' => $question->name,
                            'answered' => ($question->is_multi || $question->is_dropdown) && $answer ? $answer->value : $value
                        ]);
                    }
                }
                $order = $this->createQuestionnaireOrder($questionnaire, auth()->user());
                if ($questionnaire->is_order) {
                    $paymentUrl = $this->processPayment($order, auth()->user());
                    if ($paymentUrl) {
                        return redirect()->to($paymentUrl);
                    }
                    abort(404, 'Payment Url Failed');
                } else {
                    return redirect()->route('frontend.home')->with('success', trans('message.questionnaire_success'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('frontend.home')->with('error', 'Unknown Error while saving questionnaire');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validate = validator(request()->all(), [
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput(request()->all());
        }
        $element = Survey::whereId($id)->active()->with('users')->with(['questions' => function ($q) {
            return $q->with('answers')->orderBy('order','asc');
        }])->first();
        $user = auth()->id() ? auth()->user() : User::whereId(request()->user_id)->first();
        if ($element) {
            return view('frontend.wokiee.four.modules.survey.show', compact('element', 'user'));
        } elseif (auth()->user()->isAdmin && $element) {
            $element = Survey::whereId($id)->with('questions.answers')->first();
            return view('frontend.modules.survey.show', compact('element', 'user'));
        }
        return redirect()->route('frontend.home')->with('info', trans('message.questionnaire_not_available'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
