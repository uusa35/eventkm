<?php

namespace App\Observers;


use App\Mail\WelcomeNewUser;
use App\Models\Address;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\OrderPaid;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function created(User $user)
    {
        activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->log(strtoupper(class_basename($user)) . ' ' . __FUNCTION__);
//        $markdown = new Markdown(view(), config('mail.markdown'));
//        return $markdown->render('emails.new_user', ['user' => $user, 'settings' => Setting::first()]);
//        $user->notify(new OrderPaid());
        $user->addresses()->create([
            'name' => 'address_one',
            'content' => $user->address,
            'block' => $user->block,
            'street' => $user->street,
            'apartment' => $user->apartment,
            'floor' => $user->floor,
            'building' => $user->building,
            'country_name' => $user->country_name,
            'area' => $user->area,
            'country_id' => $user->country_id,
        ]);
        if (env('MAIL_ENABLED')) {
            Mail::to($user->email)->send(new WelcomeNewUser($user));
        }
        if(env('SMS_ENABLED')) {
            $basic  = new \Nexmo\Client\Credentials\Basic('d941ec2e', 'JtfpG03IS5PDDKYz');
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send([
                'to' => '96565772444',
                'from' => 'Vonage APIs',
                'text' => 'Hello from Vonage SMS API'
            ]);
        }

    }

    /**
     * Handle the user "updated" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function updated(User $user)
    {
        activity()->performedOn($user)
            ->causedBy(auth()->user())
            ->log(strtoupper(class_basename($user)) . ' ' . __FUNCTION__);
        $address = Address::where(['user_id' => $user->id, 'name' => 'address_one'])->first();
        if ($address) {
            $address->update([
                'name' => 'address_one',
                'content' => $user->address,
                'block' => $user->block,
                'street' => $user->street,
                'apartment' => $user->apartment,
                'floor' => $user->floor,
                'building' => $user->building,
                'country_name' => $user->country_name,
                'area' => $user->area,
                'country_id' => $user->country_id,
                'user_id' => $user->id,
            ]);
        } else {
            Address::create([
                'name' => 'address_one',
                'content' => $user->address,
                'block' => $user->block,
                'street' => $user->street,
                'apartment' => $user->apartment,
                'floor' => $user->floor,
                'building' => $user->building,
                'country_name' => $user->country_name,
                'area' => $user->area,
                'country_id' => $user->country_id,
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        activity()->performedOn($user)
            ->causedBy(auth()->user())
            ->log(class_basename($user) . ' ' . __FUNCTION__);
    }

    /**
     * Handle the user "restored" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param \App\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        activity()->performedOn($user)
            ->causedBy(auth()->user())
            ->log(class_basename($user) . ' ' . __FUNCTION__);
    }
}
