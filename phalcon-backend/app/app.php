<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */

use Phalcon\Http\Response;

$app->get('/', function () use ($app) {
  $response = new Response();
  $response->redirect('/patients');
  return $response;
});
$app->get('/patients', function () use ($app) {
  $phql = 'SELECT * FROM MyApp\Models\Patients ORDER BY name'
  ;

  $patients = $app
    ->modelsManager
    ->executeQuery($phql)
  ;

  $data = [];


  foreach ($patients as $patient) {
    $data[] = [
      'id' => $patient->id,
      'name' => $patient->name,
      'sex' => $patient->sex,
      'religion' => $patient->name,
      'phone' => $patient->phone,
      'address' => $patient->address,
      'nik' => $patient->nik,
    ];
  }
  $response = new Response();
  $payload = array("code" => 200, "message" => "Patients fetched");
  $response->setStatusCode(200, "OK");
  $response->setJsonContent(array("status" => $payload, "result" => $data));
  return $response;
  // echo json_encode($data);
});

$app->get(
  '/patients/{id:[0-9]+}',
  function ($id) use ($app) {

    $phql = 'SELECT * FROM MyApp\Models\Patients WHERE id = :id:'
    ;

    $patient = $app
      ->modelsManager
      ->executeQuery(
        $phql,
        [
          'id' => $id,
        ]
      )->getFirst()
    ;

    $response = new Response();

    if ($patient === false) {
      $response->setJsonContent(
        [
          'status' => [
            'code' => 404,
            'message' => 'Error Not Found',
          ],
        ]
      );
    } else {
      $response->setJsonContent(
        [
          'status' => [
            'code' => 200,
            'message' => 'Patient fetched',
          ],
          'result' => [
            'id' => $patient->id,
            'name' => $patient->name,
            'sex' => $patient->sex,
            'religion' => $patient->name,
            'phone' => $patient->phone,
            'address' => $patient->address,
            'nik' => $patient->nik,
          ]
        ]
      );
      return $response;
    }
    // $payload = array("code" => 200, "message" => "Patients fetched");
    // $response->setStatusCode(200, "OK");
    // $response->setJsonContent(array("status" => $payload, "result" => $patient));
  }
);

$app->post(
  '/patients',
  function () use ($app) {

    $newpatient = $app->request->getJsonRawBody();
    $phql = 'INSERT INTO MyApp\Models\Patients '
      . '(name, sex, religion, phone, address, nik) '
      . 'VALUES '
      . '(:name:, :sex:, :religion:, :phone:, :address:, :nik:)'
    ;

    $status = $app
      ->modelsManager
      ->executeQuery(
        $phql,
        [
          'name' => $newpatient->name,
          'sex' => $newpatient->sex,
          'religion' => $newpatient->religion,
          'phone' => $newpatient->phone,
          'address' => $newpatient->address,
          'nik' => $newpatient->nik,
        ]
      )
    ;

    $response = new Response();

    if ($status->success() === true) {
      $response->setStatusCode(201, 'NewPatient Created');

      $newpatient->id = $status->getModel()->id;

      $response->setJsonContent(
        [
          'status' => 'OK',
          'data' => $newpatient,
        ]
      );
    } else {
      $response->setStatusCode(409, 'Conflict');

      $errors = [];
      foreach ($status->getMessages() as $message) {
        $errors[] = $message->getMessage();
      }

      $response->setJsonContent(
        [
          'status' => 'ERROR',
          'messages' => $errors,
        ]
      );
    }

    return $response;
  }
);

$app->put(
  '/patients/{id:[0-9]+}',
  function ($id) use ($app) {

    $newpatient = $app->request->getJsonRawBody();
    $phql = 'UPDATE MyApp\Models\Patients '
      . 'SET name = :name:, sex=:sex:, religion=:religion:, phone=:phone:, address=:address:, nik=:nik: '
      . 'WHERE id = :id:'
    ;

    $status = $app
      ->modelsManager
      ->executeQuery(
        $phql,
        [
          'id' => $id,
          'name' => $newpatient->name,
          'sex' => $newpatient->sex,
          'religion' => $newpatient->religion,
          'phone' => $newpatient->phone,
          'address' => $newpatient->address,
          'nik' => $newpatient->nik,
        ]
      )
    ;

    $response = new Response();

    if ($status->success() === true) {
      $response->setStatusCode(200, 'Patient Updated');

      $newpatient->id = $status->getModel()->id;

      $response->setJsonContent(
        [
          'status' => 'OK',
          "message"=> "Patient Updated"
        ]
      );
    } else {
      $response->setStatusCode(409, 'Conflict');

      $errors = [];
      foreach ($status->getMessages() as $message) {
        $errors[] = $message->getMessage();
      }

      $response->setJsonContent(
        [
          'status' => 'ERROR',
          'messages' => $errors,
        ]
      );
    }

    return $response;
  }
);

$app->delete(
  '/patients/{id:[0-9]+}',
  function ($id) use ($app) {

    $phql = 'DELETE FROM MyApp\Models\Patients WHERE id = :id:'
    ;

    $patient = $app
      ->modelsManager
      ->executeQuery(
        $phql,
        [
          'id' => $id,
        ]
      )->getFirst()
    ;

    $response = new Response();

    if ($patient === false) {
      $response->setJsonContent(
        [
          'status' => [
            'code' => 404,
            'message' => 'Error Not Found',
          ],
        ]
      );
    } else {
      $response->setJsonContent(
        [
          'status' => [
            'code' => 200,
            'message' => 'Patient deleted',
          ],
        ]
      );
      return $response;
    }
  }
);


/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
  $app->response->setStatusCode(404, "Not Found")->sendHeaders();
  echo $app['view']->render('404');
});