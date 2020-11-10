<?php
require_once ('Chart.php');
require_once 'Chart/Dataset.php';
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
?>
<?php
session_start();

/**
 * Creates a PieChart and return it.
 * @param string $label label of the first datarow
 * @param float $value data for the datarow
 * @return PieChart the chart created
 */
function make_chart(string $label, float $value) {
    $chart = new PieChart("myChart");
    $chart->set_responsive(false);
    $dataset = new PieDataSet();
    $dataset->add_row(new PieDatarow($label, $value, Color::rand()));
    $chart->add_dataset($dataset);
    $chart->set_label('Number of Corona Cases Per Country');
    return $chart;
}

/**
 * Adds the new row to the chart with the specified label and value.
 * @param string $label label for the Datarow to add
 * @param float $value value for the Datarow to add
 */
function data_entry(string $label, float $value) {
    $_SESSION["chart"]->add_row(
        new PieDatarow($label, $value, Color::rand())
        );
}

/**
 * 
 * @return bool if input data is available
 */
function has_input(): bool {
    return (
        isset($_POST["labelInput"]) && isset($_POST["valueInput"])
     && $_POST['labelInput'] != '' && $_POST['valueInput'] != ''
    );
}

/**
 * 
 * @return bool if the Chart has been created
 */
function has_chart(): bool {
    return isset($_SESSION["chart"]);
}

/**
 * Erases all input data from POST.
 */
function unset_input(): void {
    unset($_POST["labelInput"]);
    unset($_POST["valueInput"]);
}

/**
 * Generates the Chart.
 */
function print_chart(): void {
    echo $_SESSION["chart"];
}

/**
 * Validate input
 * @param $value
 */
function validate(float $value): void{
    $number = $value;
    
    if (empty($number)){
        $msg = '<span> class ="error"> Please enter a value </span>';
    }
    else if(!is_numeric($number)){
        $msg = '<span class="error"> Data entered was not numeric</span>';
    }
    else {
        echo "valid";
    }
}

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "<link rel='stylesheet' href='example.css' />\n";
echo "</head>\n";
echo "<body>\n";
// Put a chart canvas here if required data are available.
if (has_chart() || has_input()) {
    echo "<canvas id='myChart' class='center' width='800' height='800'><p>Hello Fallback World</p></canvas>\n";
    echo "<script src='https://cdn.jsdelivr.net/npm/chart.js@2.9.3'></script>\n";
}
// Data presents.
if (has_chart()) {
    if (has_input()) {
        validate($_POST["valueInput"]);
        data_entry($_POST["labelInput"], $_POST["valueInput"]);
        unset_input();
    }
    print_chart();
}
// First run.
else {
    if (has_input()) {
        validate($_POST["valueInput"]);
        $_SESSION["chart"] = make_chart($_POST["labelInput"], $_POST["valueInput"]);
        print_chart();
        unset_input();
    }
}
echo "<form method='post' action='index.php'>\n";
echo "<table class='center'>\n";
echo "<tr>\n";
echo "<td>\n";
echo "<label for='labelInput'>Country: </label>\n";
echo "</td>\n";
echo "<td>\n";
echo "<input type='text' name='labelInput' id='labelInput' /></br>\n";
echo "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>\n";
echo "<label for='valueInput'># of Corona Cases: </label>\n";
echo "</td>\n";
echo "<td>\n";
echo "<input type='text' name='valueInput' id='valueInput' /></br>\n";
echo "</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td class='right'>\n";
echo "<input type='submit' value='Submit' />\n";
echo "</td>\n";
echo "<td>\n";
echo "<input type='reset' value='Reset' />";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</form>\n";
echo "</body>\n";
echo "</html>\n";

?>
