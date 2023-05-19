<?php

use Mockery\MockInterface;
use function Spatie\Snapshots\assertMatchesJsonSnapshot;

test('"Pracise more Mocking!" -> https://laravel.com/docs/10.x/mocking')->todo();

class NidaService
{
    public function verify()
    {
        return json_encode([
            'status' => 'success',
            'message' => 'NIDA verified',
        ]);
    }
}

class NidaVerificationController
{
    public function __construct(public NidaService $service)
    {
    }

    public function verify(): array
    {
        $data = $this->service->verify();

        return json_decode((string) $data, true, 512, JSON_THROW_ON_ERROR);
    }
}

test('it can mock a class', function (): void {

    $nidaService = $this->mock(NidaService::class, function (MockInterface $mock): void {
        $mock->shouldReceive('verify')->once()->andReturn(json_encode([
            'status' => 'success',
            'message' => 'NIDA verified',
        ]));
    });

    $nidaVerificationController = app(NidaVerificationController::class, [
        'service' => $nidaService,
    ]);

    $response = $nidaVerificationController->verify();

    expect($response)->toBeArray();

    assertMatchesJsonSnapshot(json_encode($response, JSON_THROW_ON_ERROR));
});
