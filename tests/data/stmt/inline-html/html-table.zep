namespace Malios;

class HTMLTable
{
    public function render(array data)
    {
        echo "<table>" . PHP_EOL . "    <tr>" . PHP_EOL . "        ";
        var heading;
        for heading in array_keys(data[0]) {
            echo "        <th>";
            echo heading;
            echo "</th>" . PHP_EOL . "        ";
        };
        echo "    </tr>" . PHP_EOL . "    ";
        var row;
        for row in data {
            echo "    <tr>" . PHP_EOL . "        ";
            var col;
            for col in row {
                echo "        <td>";
                echo col;
                echo "</td>" . PHP_EOL . "        ";
            };
            echo "    </tr>" . PHP_EOL . "    ";
        };
        echo "</table>" . PHP_EOL . "        ";
    }
}
