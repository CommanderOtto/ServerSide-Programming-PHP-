<?php


	function stateOptionList()
	{  	
		$list = '<option value = "IN">Indiana</option>
				<option value = "NY">New York</option>
				<option value = "IL">Illinois</option>
				<option value = "FL">Florida</option>
				<option value = "CO">Colorado</option>';

		return $list;
	}
	
	
	
	//based on code provided in-class
	//here I modified code to use filter_input.
	//ask difference between filter_var and filter_input.
	//the filter_input function contains the the sanitize email parameter.
	function EmailSanitize($UnsanitizedEmail)
	{

		$UnsanitizedEmail=filter_var($UnsanitizedEmail, FILTER_SANITIZE_EMAIL); 
		if(filter_var($UnsanitizedEmail, FILTER_SANITIZE_EMAIL))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
					
		// $UnsanitizedEmail=filter_input(INPUT_POST, $UnsanitizedEmail,FILTER_SANITIZE_EMAIL);
		
		// if(filter_var($UnsanitizedEmail,FILTER_VALIDATE_EMAIL ))
		// {
			// return TRUE;
		// }
		// else
		// {
			// return FALSE;
		// }
		
		
		
	////based on code provided in-class
	//first checks if pass is required length
	//does for loop to check for characters.
	//does for loop to check for numbers.
	function PasswordSanitize($UnsanitizedPassword)
	{
		$UnsanitizedPassword = trim($UnsanitizedPassword);
		if (strlen($UnsanitizedPassword) < 12){
			return false;
		}
		else 
		{
			//local variables containing results of each for loop.
			$characters = false;
			$numbers = false;
			
			
			//does pass contain valid characters [A-Za-z] (and not simbols)?
			$chars = str_split($UnsanitizedPassword);
			for($i = 0; $i<strlen($UnsanitizedPassword); $i++){
				if (preg_match("/[A-Za-z]/",$chars[$i])){
					$characters = true;
					break;
				}

			}

			//does pass contain valid numbers (0-9)?
			for($i = 0; $i<strlen($UnsanitizedPassword); $i++){
				if (preg_match("/[0-9]/",$chars[$i])){
					$numbers = true;
					break;
				}

			}
			
			//if password contains valid characters and valid numbers... returnn true.
			if (($characters == true) and ($numbers == true)){
				return true;
			}
			
		else return false;

		}
	}	
	
	
	function CodeValidation($UnvalidatedCode)
	{
		$UnvalidatedCode = trim($UnvalidatedCode);
		if (strlen($UnvalidatedCode) < 50){
			return false;
		}
		else 
		{
			//local variables containing results of each for loop.
			$codecharacters = false;
			$codenumbers = false;
			
			
			//does pass contain valid characters [A-Za-z] (and not simbols)?
			$codechars = str_split($UnvalidatedCode);
			for($i = 0; $i<strlen($UnvalidatedCode); $i++){
				if (preg_match("/[A-Za-z]/",$codechars[$i])){
					$codecharacters = true;
					break;
				}

			}

			//does pass contain valid numbers (0-9)?
			for($i = 0; $i<strlen($UnvalidatedCode); $i++){
				if (preg_match("/[0-9]/",$codechars[$i])){
					$codenumbers = true;
					break;
				}

			}
			
			//if password contains valid characters and valid numbers... returnn true.
			if (($codecharacters == true) and ($codenumbers == true)){
				return true;
			}
			
		else return false;

		}
	}

	// function that generates the code for email activation. Based on notes from Lingma.
	function randomCodeGenerator($length)
	{
		$code = "";
		for($i = 0; $i<$length; $i++)
		{
			//generate a random number between 1 and 35
			$r = mt_rand(1,35);
			//if the number is greater than 26, minus 26 will generate a digit between 0 and 9
			if ($r > 26) 
			{
				$r = $r - 26;
				$code = $code.$r ;
			}
			else 
			{
				//it's between 1 and 26, generate a character
				$code = $code.toChar($r);
			}

		}
		return $code;

	}
	
	function toChar($digit){
         $char = "";
         switch ($digit)
		{
                case 1: $char = "A"; break;
                case 2: $char = "B"; break;
                case 3: $char = "C"; break;
                case 4: $char = "D"; break;
                case 5: $char = "E"; break;
                case 6: $char = "F"; break;
                case 7: $char = "G"; break;
                case 8: $char = "H"; break;
                case 9: $char = "I"; break;
                case 10: $char = "J"; break;
                case 11: $char = "K"; break;
                case 12: $char = "L"; break;
                case 13: $char = "M"; break;
                case 14: $char = "N"; break;
                case 15: $char = "O"; break;
                case 16: $char = "P"; break;
                case 17: $char = "Q"; break;
                case 18: $char = "R"; break;
                case 19: $char = "S"; break;
                case 20: $char = "T"; break;
                case 21: $char = "U"; break;
                case 22: $char = "V"; break;
                case 23: $char = "W"; break;
                case 24: $char = "X"; break;
                case 25: $char = "Y"; break;
                case 26: $char = "Z"; break;
                default: "A";

        }
         return $char;
		 
	}

			
?>
		
		