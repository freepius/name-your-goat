<?php

namespace NameYourGoat\Repository;

class Proposal
{
    public static function do(object $user, object $goat, string $name, string $theme)
    {
        // Log the proposal
        $log = fopen(__DIR__.'/../data/proposals.log', 'a');

        fwrite($log, sprintf(
            "%s, %s => %s: name = %s, theme = %s\n",
            date('y-m-d H:i:s'),
            $user->name,
            $goat->ID,
            $name,
            $theme
        ));

        fclose($log);

        // Send an email to the admin
        $success = mail(
            ADMIN_EMAIL,
            "New proposal from {$user->name}, for the goat {$goat->ID}",
            "{$user->name} did a proposal for the goat {$goat->ID}:\r\nname = $name, theme = $theme",
            "Reply-To: {$user->emails}"
        );
    }
}
