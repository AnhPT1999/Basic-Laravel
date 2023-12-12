<?php

namespace App\Jobs;

use App\Models\Post;
use App\Service\PostServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class TestCreatePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(PostServiceInterface $service): void
    {
        dd('test');
    }
}
