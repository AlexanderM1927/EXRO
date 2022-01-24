<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $setting = new Setting;
        $setting->map = 'calculate_text';
        $setting->field = 'Leyenda en las formulas';
        $setting->value = '<p>La información proporcionada a través de la plataforma de “Cálculos Programas Químicos” se ofrece de buena fe. Los usuarios de la información asumen todos los riesgos y responsabilidades y liberan expresamente a Exro SAS y Quimexcol Zona Franca SAS, sus funcionarios y agentes de cualquier responsabilidad. Debido a que las condiciones de uso y datos de cada proceso pueden cambiar con el tiempo, o con las condiciones actualizadas. Los usuarios de la información aquí establecida o generada durante el uso de la plataforma son responsables de determinar la idoneidad de la información. Ante cualquier inquietud se debe acudir a nuestro Equipo Técnico y/o de Ventas y Servicios para aclarar o interpretar los resultados. Los usuarios de la plataforma no están autorizados para compartir la información o tecnología.&nbsp;</p>';

        $setting->save();
    }
}
