<?php

namespace App\Modules\Event\Console;

use Illuminate\Console\Command;

class FetchTweets extends Command
{
    protected $signature = 'fetch:twitter-stream';

    protected $description = 'Fetch tweets for an event';

    public function handle()
    {
        app(\Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi::class)
            ->publicStream()
            ->whenHears([
                'test123',
                'laravel'
            ], function(array $tweet) {
                echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
                \Log::info("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");
            })
            ->startListening();
    }
}