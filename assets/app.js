/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import $ from 'jquery';

/**
 * Simple (ugly) code to handle the comment vote/down
 */
let $container = $('.js-vote-arrows');
$container.find('a').on('click', (e) => {
    e.preventDefault();
    let $link = $(e.currentTarget);

    $.ajax({
        url: '/comments/10/vote/' + $link.data('direction'),
        method: 'POST'
    }).then(data => {
        $container.find('.js-vote-total').text(data.votes);
    })
});

