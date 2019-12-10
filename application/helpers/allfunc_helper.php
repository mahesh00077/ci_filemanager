<?php

function replace_a_line($data) {
	if (stristr($data, '<link rel="stylesheet" href="')) {
		return '<link rel="stylesheet" href="<?php echo base_url();?>/assets/';
	}
	return $data;
}