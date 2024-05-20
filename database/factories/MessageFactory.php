<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderId = $this->faker->randomElement([0,1]);
        if($senderId == 0){
            $senderId = $this->faker->randomElement(\App\models\User::where('id', '!=', 1)->pluck('id')->toArray());
            $receiverId = 1;
        }else{
            $receiverId = $this->faker->randomElement(\App\models\User::pluck('id')->toArray());
        }

        $groupId = null;

        if($this->faker->boolean(50)){
            $groupId = $this->faker->randomElement(\App\models\Group::pluck('id')->toArray());
            // select group from group id
            $group = \App\models\Group::find($groupId);
            $receiverId = null;
            // to get the sender id from the group users 
            $senderId = $this->faker->randomElement($group->users->pluck('id')->toArray());
        }

        return [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'group_id' => $groupId,
            'message'=>$this->faker->realText(200),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
