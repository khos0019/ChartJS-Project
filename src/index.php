<?php
require_once ('Chart.php');
require_once 'Chart/Dataset.php';
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
require_once ('Charts/Bar_chart.php');
require_once ('Charts/Bar_chart/Datarow.php');
?>
<?php
session_start();

/**
 * Returns the color input by user.
 * @return color input by user
 */
function getColorInput(): Color {
    $color = null;
    if (isset($_POST["colorInput"])) {
	$color = Color::hex($_POST["colorInput"]);
	unset($_POST["colorInput"]);
    }
    else {
        $color = Color::rand();
    }
    return $color;
}

/**
 * Creates a PieChart and return it.
 * @param string $label label of the first datarow
 * @param float $value data for the datarow
 * @return PieChart the chart created
 */
function make_piechart(string $label, float $value) {
    $chart = new PieChart("myChart");
    $chart->set_responsive(false);
    $dataset = new PieDataSet();
    $dataset->add_row(new PieDatarow($label, $value, getColorInput()));
    $chart->add_dataset($dataset);
    $chart->set_label("Number of Corona Cases Per Country");
    return $chart;
}

/**
 * Creates a Barchart and return it.
 * @param string $label label of the first datarow
 * @param float $value data for the datarow
 * @return Barchart the chart created
 */
function make_barchart(string $label, float $value) {
    $chart = new BarChart("myChart");
    $chart->set_responsive(false);
    $dataset = new BarDataSet();
    $dataset->add_row(new BarDatarow($label, $value, getColorInput()));
    $dataset->set_label("Number of Corona Cases Per Country");
    $chart->add_dataset($dataset);
    $chart->set_label("Number of Corona Cases Per Country");
    return $chart;
}

/**
 * Adds the new row to the piechart with the specified label and value.
 * @param string $label label for the Datarow to add
 * @param float $value value for the Datarow to add
 */
function data_entry_piechart(string $label, float $value) {
    $_SESSION["chart"]->add_row(
        new PieDatarow($label, $value, getColorInput())
    );
}

/**
 * Adds the new row to the barchart with the specified label and value.
 * @param string $label label for the Datarow to add
 * @param float $value value for the Datarow to add
 */
function data_entry_barchart(string $label, float $value) {
    $_SESSION["chart"]->add_row(
        new BarDataRow($label, $value, getColorInput())
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
        //If user had created a pie chart.
        if($_POST["chartSelection"] == "Pie Chart") {
            data_entry_piechart($_POST["labelInput"], $_POST["valueInput"]);
            unset_input();
        }
        //If user had created a bar chart.
        else if($_POST["chartSelection"] == "Bar Chart") {
            data_entry_barchart($_POST["labelInput"], $_POST["valueInput"]);
            unset_input();
        }
    }
    print_chart();
}
// First run.
else {
    if (has_input()) {
        //If user selects to create a pie chart.
        if($_POST["chartSelection"] == "Pie Chart") {
            $_SESSION["chart"] = make_piechart($_POST["labelInput"], $_POST["valueInput"]);
            print_chart();
            unset_input();
        }
        //If user selects to create a bar chart.
        else if($_POST["chartSelection"] == "Bar Chart") {
            $_SESSION["chart"] = make_barchart($_POST["labelInput"], $_POST["valueInput"]);
            print_chart();
            unset_input();
        }
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
echo "<input type='number' step='0.001' required name='valueInput' id='valueInput' /></br>\n";
echo "</td>\n";
echo "</tr>\n";
echo "<tr>";
echo "<td>";
echo "<label for='colorInput'>Color code:</label>\n";
echo "</td>";
echo "<td>";
echo "<input type='color' name='colorInput' id='colorInput' />";
echo "</td>";
echo "</tr>";
echo "<tr>\n";
echo "<td>\n";
echo "<label for='chartSelection'>Select a Chart: </label>\n";
echo "</td>\n";
echo "<td>\n";
echo "<select name='chartSelection'>";
echo "<option>";
echo "Pie Chart";
echo "</option>";
echo "<option>";
echo "Bar Chart";
echo "</option>";
echo "</select>";
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
