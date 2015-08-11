<?php
header('Content-Type: application/json');

$d='{
        "labels" : ["January","February","March","April","May","June","July"],
        "datasets" : [
                {
                        "fillColor" : "rgba(220,220,220,0.5)",
                        "strokeColor" : "rgba(220,220,220,0.8)",
                        "highlightFill": "rgba(220,220,220,0.75)",
                        "highlightStroke": "rgba(220,220,220,1)",
                        "data" : [100,97,50,68,94,34,10]
                },
                {
                        "fillColor" : "rgba(151,187,205,0.5)",
                        "strokeColor" : "rgba(151,187,205,0.8)",
                        "highlightFill" : "rgba(151,187,205,0.75)",
                        "highlightStroke" : "rgba(151,187,205,1)",
                        "data" : [123,43,87,98,77,66,4]
                },
                {
                        "fillColor" : "rgba(255,187,205,0.5)",
                        "strokeColor" : "rgba(255,187,205,0.8)",
                        "highlightFill" : "rgba(255,187,205,0.75)",
                        "highlightStroke" : "rgba(255,187,205,1)",
                        "data" : [43,87,98,67,78,76,97]
                }

        ]

}';
$d = trim(preg_replace('/\s\s+/', ' ', $d));
echo json_encode($d);
?>

