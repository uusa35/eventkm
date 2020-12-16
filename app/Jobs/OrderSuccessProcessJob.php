<?php

namespace App\Jobs;

use App\Mail\OrderComplete;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Services\Traits\OrderTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;



class OrderSuccessProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, OrderTrait;
    public $user;
    public $order;
    public $contactus;
    public $emailsList;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $user, Setting $contactus)
    {
        $this->user = $user;
        $this->order = $order;
        $this->contactus = $contactus;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->emailsList = [$this->contactus->email, $this->order->email];
        if (env('ORDER_MAILS') && env('MAIL_ENABLED')) {
            foreach (explode(',', env('ORDER_MAILS')) as $mail) {
                array_push($this->emailsList, $mail);
            }
        }
        if (env('INVOICE_DISTRIBUTION')) {
            $this->order->order_metas->each(function ($orderMeta) {
                if ($orderMeta->isProductType) {
                    array_push($this->emailsList, $orderMeta->product->user->email);
                } else {
                    array_push($this->emailsList, $orderMeta->service->user->email);
                }
            });
        }
        if (env('MIRSAL_ENABLED')) {
            $this->createOrderForMirsal($this->order, $this->user);
        }
        return Mail::to($this->emailsList)->send(new OrderComplete($this->order, $this->user));
    }
}
