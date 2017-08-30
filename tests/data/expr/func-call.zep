namespace Malios;

class Helper
{
    public function joinOnSteroids(string glue, array arr)
    {
        var lower, upper, original;
        let original = join(glue, arr);
        let upper = strtoupper(original);
        let lower = strtolower(upper);
        return [
            "lowercase": lower,
            "uppercase": upper,
            "original": original
        ];
    }
}
