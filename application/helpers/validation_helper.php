<?php



	function validate($context) {
		$output = array();
		$output['status'] = false;
		$context->form_validation->set_error_delimiters('', '');
		$validated = $context->form_validation->run();
		if ($validated)
		{
			$output['status'] = true;
			$output =  $output;
		}
		else
		{
			$output['errors'] = validation_errors();
		}
		if (array_key_exists('errors', $output)) {
			$errors = explode("\n", $output['errors']);
			foreach ($errors as $key => $error) {
				$errors[$key] = $error;//json_decode($error);
			}
			$output['errors'] = $errors;
		}
		/*
		if (defined('PHPUNIT_TEST')) {
			return json_encode(array('output' => $output));
		} else {
			$context->load->view('json', array('output' => $output));
		}
		*/
		//return json_encode(array('output' => $output));
		return $output;
	}
