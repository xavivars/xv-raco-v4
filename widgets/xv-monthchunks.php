<?php


class XV_Monthchunks_Widget extends WP_Widget {
	function XV_Monthchunks_Widget() {
		parent::WP_Widget(false,$name = 'Arxius del blog');
	}
	
	function widget($args, $instance) {             
			extract($args);
			echo $before_widget, $before_title, 'Arxius del blog', $after_title, '<ul>' ;
			
			self::xv_monthchunks('ascending','cat');
			
        	echo '</ul>',$after_widget;
        }
	
	static function xv_monthchunks($year_order = "ascending", $month_format = "number") {
		// get access to wordpress' database object
		global $wpdb;
		$current_month = "";
		$current_year  = "";
		
		// get current year/month if current page is monthly archive
		if (is_month())
		{
			$current_month = get_the_time('n');
			$current_year  = get_the_time('Y');
		}
		
		// set SQL order by sort order
		if ($year_order == "descending")
		{
			$year_order = "DESC";
		}
		else
		{
			$year_order = "ASC";
		}

		$month_catala=false;

		// set format for month display
		if ($month_format == "alpha")
		{
			$month_format = "LEFT(DATE_FORMAT(post_date, '%M'), 1)";
		}
		elseif ($month_format == "cat" )
		{
			$month_format = "DATE_FORMAT(post_date, '%M')";
			$mcatala=true;
		}
		else
		{
			$month_format = "DATE_FORMAT(post_date, '%c')";
		}
		
		$month_mini = "DATE_FORMAT(post_date, '%b')";

		// get an array of the years in which there are posts
		$wpdb->query("SELECT DATE_FORMAT(post_date, '%Y') as post_year
					  FROM $wpdb->posts
					  WHERE post_status = 'publish'
					  AND post_type = 'post'
					  GROUP BY post_year
					  HAVING post_year <> '0000'
					  ORDER BY post_year $year_order");
		$years = $wpdb->get_col();
		
		// each list item will be the year and the months which have blog posts
		foreach($years as $year)
		{
			// get an array of months for the current year without leading zero
			// sort by month with leading zero
			$months = $wpdb->get_results("SELECT DATE_FORMAT(post_date, '%c') as post_month, 
										  $month_format AS display_month,
										  $month_mini as mini_month, 
										  DATE_FORMAT(post_date, '%M') as post_month_name
										  FROM $wpdb->posts
										  WHERE DATE_FORMAT(post_date, '%Y') = $year
										  AND post_status = 'publish'
										  AND post_type = 'post'
										  GROUP BY DATE_FORMAT(post_date, '%m')
										  ORDER BY post_date");

			// start the list item displaying the year
			print "<li><strong>$year</strong><br />\n";
			
			// loop through each month, creating a link
			// followed by a single space
			$month_count = count($months);
			$i = 0;
			foreach($months as $month)
			{
					$mdsp = 'blabla';

					if ($mcatala == true)
					{
						$mdsp = __($month->mini_month.'_'.$month->display_month.'_abbreviation');
					}
					else
						$mdsp = '++'.$month->display_month.'++';

				// display the current month in bold without a link
				if ($year == $current_year && $month->post_month == $current_month)
				{
					print "<strong title='$month->post_month_name $year'>$mdsp</strong>";
				}
				else
				{
					print '<a href="' . get_month_link($year, $month->post_month) . '" title="'.__($month->post_month_name).' '.$year.'">' . $mdsp . "</a>";
				}

				if ($i < $month_count-1)
				{
					print " \n";
				}
				$i++;
			}

			//end the year list item
			print "</li>\n\n";
		}
	}
}

register_widget('XV_Monthchunks_Widget');

?>
