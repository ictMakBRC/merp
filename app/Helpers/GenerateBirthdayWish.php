<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class GenerateBirthdayWish
{
    public static function generate()
    {
        $wishes = [
            'For all the good work you have done, it’s not enough to say that you are just a good employee. It’s decided- you are (to put it simply) a great person! May every day be filled with happiness, good health, and marvelous luck. Enjoy your birthday and a great year ahead.',
            'Accordingly, for being the most incredible employee and the most versatile member of our team, your birthday is a big deal for us. Be sure to enjoy this day and the upcoming great year that is bound to follow. Happiest birthday to you.',
            'A good employee is rare. A great employee is a myth. Except for the fact that we discovered the latter in you. We all see you as being an integral part of our business and team. May this birthday usher in a new era of harmony, joy, and fortune for you. Warm greetings on your birthday.',
            'This day is momentous, considering that you circumvented the sun once more. May this signify a series of greats for you- a great day, a great year, a great life. Thus, put on a smile and enjoy this day to the fullest. Happy Birthday!',
            "It's your birthday, and putting up a great smile on your face is warranted. For all the outstanding work you've done, you deserve all the accolades and more. Don't worry, we are not going to ask you for a treat.",
            'Happy birthday to a person who is always there for any member of our team, who manages to pull off a great job, who’s a great person overall, and an even more wonderful employee. Enjoy this day to your fullest!',
            'An amazing employee like you is more priceless to us than our everyday problems. Even more surprising is how you manage to build a stronger bond each day with every member of our team. Finally wishing that your every day is filled with happiness and good health. Happy birthday!',
            'Today is a great day to get started on another 365-day journey. It’s a fresh start to new beginnings, new hopes, and great endeavors. Besides, be sure to have adventures along the way. Wishing you the best of today and every day in the future!',
            'As an esteemed member of our team, it is crucial that you put a smile on your face because nothing less is allowed on your birthday. In other words, happy birthday!',
            'Hoping that the rest of your year be filled with the same amount of happiness, friendliness, and love that you bring among all the members of our team. Thereby, enjoy this day because you deserve more than the best. Happy birthday to you!',
            'A great person deserves remarkable things. And we expect nothing less from you because you are the warmest and the most deserving person to whom amazing things should happen. Wishing you a wonderful birthday and a great year ahead!',
            'To say that you are a great addition to our team would be a significant understatement. Moreover, you are someone who ensures that every member of our team has someone to talk to in times of crisis and in times of joy. Happiest birthday to the most amazing employee and an even greater friend!',
            'Words alone are not enough to express how talented and humble you are. Likewise, your very nature makes every day of our work life a pleasure, and we couldn’t wish but a very amazing year ahead of you. The warmest wishes and the happiest regards on your birthday!',
            'People say that you are the sum total of your experiences in your life. Well, your sum total must be pretty amazing because you are a great person and an even more amazing employee. I wish you a great year filled with happiness ahead!',
            'To the dictionary definition of a good employee, we want to wish you the warmest of birthdays. Above all, always remain the same friendly, helpful, and overall marvelous person. A great year (and many more) is in store for you.',
            "We feel proud to call you our employee. The world is your oyster, and the opportunities are endless. Here's to a great year filled with happiness, success, and good health. Wishing you a happy birthday!",
            'The warmest wishes for the dearest member of our team. Besides, you make work seem less like work, and we would forever be grateful to you. Happy returns of the day!',
            'Even during hard times, we know that you would come and put a smile on the faces of every member of our team. For your hardworking, humble, and happy self, we wish you the best of everything that life has to offer. So, happy birthday and sending you lots of love through this birthday message.',
            'You have managed to fulfill every expectation, ride over every obstacle while being an amazing employee. You must be no less of a superhuman to achieve these feats. It makes us glad about the day we decided to hire you. Wishing you the happiest birthday!',
            'If there is a checklist for being an amazing employee, yours would be ticked in all the right boxes. You are an exemplary member of our team and an even better person. So, happy birthday and wishing you success in every path of your life.',
            'Finally, you have evolved from being a new hire to an amazing employee to being a part of this family. Besides, you were never the one to give up on any challenge or back down during our hard times. In short, you are one of the best things to happen to this company and an inspiration to have. Happy birthday to you!',
            'Happy birthday to the most hardworking and dedicated member of our team. May this birthday be the start of a prosperous and happy year ahead. So put a smile on your face and continue being the fantastic employee that you always are.',
            'If a phenomenal employee existed, she would look and act like you. May you enjoy many more years of lifting people up and spreading your joy around like confetti. Here’s wishing the great member of our team, happy birthday!',
            "We're so fortunate to have you as a member of our team who encourages us every day to succeed. May this special day be full of joy, and may you have a successful life ahead. Happy birthday to you!",
            'Happy birthday to a phenomenal employee who means so much to every member of our team. May you continue doing the excellent work you always do, and we all wish that this birthday brings you every happiness in the world.',
            'Hoping that this birthday is the start of an amazing year where you accomplish every goal and shatter every record there is to break. Enjoy your birthday!',
            'May this birthday bring the milestones you have to achieve, dreams you have to fulfill, and horizons you have to conquer. Wishing you a happy birthday from every member of our team!',
            'Since the day you joined our team, you have been nothing but a great person to every member of our team. So we wish you a great year of smashing your goals, taking the unknown roads, and put a smile on your face. Happy Birthday!',
            'You are too exciting a person to celebrate your birthday with us. Our birthday gift to you is the day off. So go on, put a smile on that face and enjoy this face to the fullest. In short, happy birthday!',
            "Today seems to a little bit brighter, a bit of fun, a little bit sunnier. Particularly because it's your birthday! We are blessed to have a fantastic employee like you and wish you all the best for all your endeavors in life. Many, many happy returns of the day!",
        ];

        return Collection::make($wishes)->map(fn ($wish) => $wish)->random();
    }
}
