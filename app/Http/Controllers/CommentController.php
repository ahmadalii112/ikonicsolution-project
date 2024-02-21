<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param  Feedback  $feedback
     * @return View
     */
    public function create(Feedback $feedback): View
    {
        $comments = Comment::with('user')->paginate(5);
        return view('comments.create', compact('feedback', 'comments'));
    }

    /**
     * @param  CommentRequest  $request
     * @param  int  $feedbackId
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, int $feedbackId)
    {
        $comment = auth()->user()->comments()->create([
            'content' => $request->validated('content'),
            'feedback_id' => $feedbackId,
        ]);

        // Parse comment text to find mentions
        $commentText = $comment->content;
        preg_match_all('/@(\w+)/', $commentText, $matches);
        $mentionedUsernames = $matches[1]; // Extract usernames without '@'

        // Retrieve mentioned users from the database
        $mentionedUsers = User::whereIn('name', $mentionedUsernames)->get();

        // Display mentioned users in the comment
        foreach ($mentionedUsers as $mentionedUser) {
            $mentionedUsername = '@' . $mentionedUser->name;
//            $mentionedLink = url("/user/profile/{$mentionedUser->id}"); // Example URL for user profile
            $commentText = Str::replaceFirst($mentionedUsername, "<a href='' class='text-indigo-600'>{$mentionedUsername}</a>", $commentText);
        }
        // Update the comment content with formatted text (with mention links)
        $comment->content = $commentText;
        $comment->save();

        return redirect()->route('comment.create', $feedbackId)->withFragment('comments');
    }

}
