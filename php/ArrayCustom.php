$result = collect($array1)->map(function ($value, $key) use ($array2) {
return $value / $array2[$key];
});