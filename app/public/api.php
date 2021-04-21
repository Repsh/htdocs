
<?php 

header('Content-type: application/json; charset=utf-8');
$output = [
    'message' => "Hello world",
    'status' => "success"
];

$firstnames = json_decode(file_get_contents('../code/firstnames.json'), true);
$lastnames = json_decode(file_get_contents('../code/lastnames.json'), true);
$age = json_decode(file_get_contents('../code/age.json'), true);

if (array_key_exists('fields', $_REQUEST) && is_array($_REQUEST['fields'])) {
    $gender = ['male', 'female'];
    $gender = $gender[rand(0, 1)];

    $age = $age[rand(1, 100)];


    if (in_array('firstname', $_REQUEST['fields'])) {
        $all_names = $firstnames[$gender];

        $count = count($all_names);
        $rand_key = rand(0, $count - 1);
        $firstname = $all_names[$rand_key];


        unset($output['message']);
        $output['firstname'] = $firstname;
    }

    if (in_array('lastname', $_REQUEST['fields'])) {
        $all_names = $lastnames[$gender];

        $count = count($all_names);
        $rand_key = rand(0, $count - 1);
        $lastname = $all_names[$rand_key];



        unset($output['message']);
        $output['lastname'] = $lastname;
    }

    if (in_array('age', $_REQUEST['fields'])) {
        $all_ages = $age[$age];

        $count = count($all_ages);
        $rand_key = rand(0, $count - 1);
        $age = $all_ages[$rand_key];



        unset($output['message']);
        $output['age'] = $age;
    }
}

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


?>
