<?php

namespace App\Http\Service;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CommentService
{
    /**
     * @return LengthAwarePaginator
     */
    public function listComments(): LengthAwarePaginator
    {
        return Comment::with('user')->paginate(5);
    }

    /**
     * @param  array  $data
     * @param  int  $feedbackId
     * @return Comment|Model
     */
    public function createComment(array $data, int $feedbackId): Model|Comment
    {
        $comment = auth()->user()->comments()->create([
            'content' => $data['content'],
            'feedback_id' => $feedbackId,
        ]);
        $this->parseCommentTextToFindMentions($comment);
        return $comment;
    }

    /**
     * @param  Model|Comment  $comment
     * @return void
     */
    public function parseCommentTextToFindMentions(Model|Comment $comment): void
    {
        // Parse comment text to find mentions
        $commentText = $comment->content;
        preg_match_all('/@(\w+)/', $commentText, $matches);
        $mentionedUsernames = $matches[1]; // Extract usernames without '@'

        // Retrieve mentioned users from the database
        $mentionedUsers = User::whereIn('name', $mentionedUsernames)->get();

        // Display mentioned users in the comment
        foreach ($mentionedUsers as $mentionedUser) {
            $mentionedUsername = '@'.$mentionedUser->name;
            $commentText = Str::replaceFirst($mentionedUsername,
                "<a href='' class='text-indigo-600'>{$mentionedUsername}</a>", $commentText);
        }
        // Update the comment content with formatted text (with mention links)
        $comment->content = $commentText;
        $comment->save();
    }
}
