<?php

	function get_written_data($data,$any=false)
	{
		$mesos  = array( "01" => "de gener",      "02" => "de febrer",
				         "03" => "de març",      "04" => "d'abril",
				         "05" => "de maig",       "06" => "de juny",
				         "07" => "de juliol",      "08" => "d'agost",
				         "09" => "de setembre", "10" => "d'octubre",
				         "11" => "de novembre",  "12" => "de desembre",
				  );

		$text = '';
		if(isset($data))
		{
			preg_match_all("/(\d\d)\/(\d\d)\/(\d\d\d\d)/",$data,$matches);

			if((sizeof($matches)==4)&&(sizeof($matches[0])))
			{
				//print_r($matches);

				$text = $matches[1][0].' '.$mesos[$matches[2][0]];
				if($any) $text .= ' de '.$matches[3][0];
			}
		}

		if($text == '')
		{
			$text = 'DATA DESCONEGUDA';
		}

		return $text;

	}


?>
