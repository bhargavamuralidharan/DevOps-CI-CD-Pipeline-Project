<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	function menu_active($check, $value)
	{
		if(isset($value) && isset($check))
		{
			if($value == $check)
			{
				echo ' class="active" ';
			}
		}
	}
