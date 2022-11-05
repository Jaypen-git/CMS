<?php
if ($_GET[myOrder] != ""){ // if there is a var on the URL and it's not empty
	$myOrder=$_GET['myOrder'];// retrieve its value
} else {
	$myOrder="question_id";
}
require( "../config.php" );
$sql_get_all = "SELECT * FROM questions_tbl ORDER BY $myOrder";
$result = $makeconnection->query( $sql_get_all );
$overAllPoints = 0;
$num=0;
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Questions- Read</title>
	<link href="cms_style.css" rel="stylesheet" type="text/css">
	<script>
		function JS_delete_item( question_id ) {
			if ( confirm( 'Are you sure you want to delete this question?' ) ) {
				window.location.href = 'quiz_delete.php?id=' + question_id;
			}
		}
	</script>
</head>

<body>
	<div id="container">
	  <header>
		<h1>CMS (teacher area): View Quiz</h1>
		<p><a href="student_results.php">view student results</a></p>

	  </header>

		<main>
		  <p>
			<a href="quiz_read.php?myOrder=question_id"><button>Order by ID low to high</button></a>
			<a href="quiz_read.php?myOrder=question_id DESC"><button>Order by ID high to low</button></a>
		  </p>
		  <p>
			<a href="quiz_read.php?myOrder=question_points"><button>Order by Points low to high</button></a>
			<a href="quiz_read.php?myOrder=question_points DESC"><button>Order by Points high to low</button></a>
		  </p>
		  <p>
			<a href="quiz_read.php?myOrder=question_statement"><button>Order by Statement Alphabetical a-z</button></a>
			<a href="quiz_read.php?myOrder=question_statement DESC"><button>Order by Statement Alphabetical z-a</button></a>
		  </p>
		  <p>
			<a href="quiz_read.php?myOrder=question_answer DESC"><button>Order by Answer true</button></a>
			<a href="quiz_read.php?myOrder=question_answer"><button>Order by Answer false</button></a>
		  </p>
		  <table width="100%" border="0">
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>Statement</th>
					<th>Answer</th>
					<th>Points</th>
					<th>Modify</th>
					<th>Delete</th>

				</tr>

			<?php while ($row = $result->fetch_assoc()) { ?>
				<tr>
				<td>
						<?php $num++; echo $num ?>
					</td>	
					
					
					<td>
						<?php echo $row["question_id"]; ?>
					</td>
					<td>
						<?php echo $row["question_statement"]; ?>
					</td>
					<td>
						<?php  echo  ($row["question_answer"] == 1) ? "true" : "false" ; ?>
					</td>
					<td>
						<?php echo $row["question_points"]; ?>
					</td>
					<td><a href="quiz_modify.php?id=<?php echo $row["question_id"]; ?>"><button>Modify</button></a>
					</td>
					<td><a href="javascript:JS_delete_item(<?php echo $row['question_id']; ?>);"><button>Delete</button></a>
					</td>
				</tr>


				<?php

				$overAllPoints += $row[ "question_points" ];

				} //end while


				?>

				<tr class="tableTotals">
					<td colspan="4" align="right">
						<p style="text-align: right">The total number of points in the quiz is:</p>
						<p style="text-align: right"> Each points in the quiz is worth:</p>

					</td>
					<td colspan="3">
						<p>
							<?php echo $overAllPoints ?>
					  </p>
						<p>
							<?php echo number_format(100/$overAllPoints,2) ?>% </p>
				  </td>
			</tr>


		  </table>
			<br>
		<p>	<a href="quiz_add.php"><button>Add Question</button></a></p>
		
<p>	<a href="../index.php"><button>Back to top portal</button></a>	</p>



	  </main>
		<!--end main-->


	</div>
	<!--end container-->
</body>
</html>