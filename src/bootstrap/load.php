<?php

add_action(
	'init',
	function () {

		$test = sanitize_text_field( wp_unslash( $_GET['test'] ?? '' ) );
	}
);
