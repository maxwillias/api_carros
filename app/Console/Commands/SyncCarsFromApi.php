<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncCarsFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Baixa JSON da API e sincroniza com banco de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "https://hub.alpes.one/api/v1/integrator/export/1902";

        $this->info("Baixando dados de {$url} ...");

        try {
            $response = Http::retry(3, 1000)->timeout(30)->get($url);

            if ($response->failed()) {
                $this->error("Falha ao acessar a API após 3 tentativas");
                return 1;
            }

            $cars = $response->json();

            if (isset($cars['id'])) {
                $cars = [$cars];
            }

            foreach ($cars as $car) {
                Car::updateOrCreate(
                    ['external_id' => $car['id']],
                    [
                        'type'            => $car['type'] ?? null,
                        'brand'           => $car['brand'] ?? null,
                        'model'           => $car['model'] ?? null,
                        'version'         => $car['version'] ?? null,
                        'year_model'      => $car['year']['model'] ?? null,
                        'year_build'      => $car['year']['build'] ?? null,
                        'optionals'       => $car['optionals'] ?? [],
                        'doors'           => $car['doors'] ?? null,
                        'board'           => $car['board'] ?? null,
                        'chassi'          => $car['chassi'] ?? null,
                        'transmission'    => $car['transmission'] ?? null,
                        'km'              => (int) ($car['km'] ?? 0),
                        'description'     => $car['description'] ?? null,
                        'created_at_api'  => $car['created'] ?? null,
                        'updated_at_api'  => $car['updated'] ?? null,
                        'sold'            => (bool) ($car['sold'] ?? false),
                        'category'        => $car['category'] ?? null,
                        'url_car'         => $car['url_car'] ?? null,
                        'old_price'       => $car['old_price'] ?? null,
                        'price'           => $car['price'] ?? null,
                        'color'           => $car['color'] ?? null,
                        'fuel'            => $car['fuel'] ?? null,
                        'fotos'           => $car['fotos'] ?? [],
                    ]
                );
            }

            $this->info("Sincronização concluída com sucesso!");
            return 0;

        } catch (\Exception $e) {
            $this->error("Erro: " . $e->getMessage());
            return 1;
        }
    }
}
