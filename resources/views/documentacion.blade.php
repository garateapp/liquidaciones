<x-app-layout>
    <x-slot name="header">
       
    </x-slot>


        <main class="p-5 bg-light-blue">
          <div class="flex justify-center items-start my-2">
            <div class="w-full sm:w-10/12 md:w-1/2 my-1">
              <h2 class="text-xl font-semibold text-vnet-blue mb-2">DOCUMENTACIÓN - PORTAL APPGREENEX.CL</h2>
              <ul class="flex flex-col">
                <li class="bg-white my-2 shadow-lg" x-data="accordion(1)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>¿Como Crear un Usuario?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir al link <a href="https://greenexweb.cl/register" target="_blank">https://greenexweb.cl/register</a>
                    </p>
                    <p class="p-3 text-gray-900">
                        Paso 2: Rellenar formulario con Nombre, Correo y Contraseña
                      </p>
                   
                  </div>
                </li>
                <li class="bg-white my-2 shadow-lg" x-data="accordion(2)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>¿Como Crear una Temporada?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir al link <a href="https://greenexweb.cl/temporada/create" target="_blank">https://greenexweb.cl/temporada/create</a>
                    </p>
                    <p class="p-3 text-gray-900">
                        Paso 2: Rellenar formulario con Nombre de la temporada
                      </p>
                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(3)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>¿Como Ingresar la data de la temporada?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir al listado de temporadas, seleccionar Temporada que desea agregar data.
                    </p>
                    <img src="{{asset('documents/temporadalist.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Seleccionar el tipo de Data que desea agregar.
                      </p>
                      <img src="{{asset('documents/dataincert.png')}}" class="w-full px-8" alt="">

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(4)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>1) ¿Como Ingresar el archivo "BALENCE DE MASA"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "balance de masa"
                    </p>
                    <img src="{{asset('documents/dataincert.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 21 columnas:<br>
                        [
                          'tipo_g_produccion',
                          'numero_g_produccion',
                          'fecha_g_produccion_sh',
                          'semana',
                          'folio',
                          'r_productor',
                          'c_productor',
                          'n_productor',
                          'n_especie',
                          'n_variedad',
                          'c_embalaje',
                          'n_embalaje',
                          'n_categoria',
                          't_categoria',
                          'n_categoria_st',
                          'n_calibre',
                          'n_etiqueta',
                          'cantidad',
                          'peso_neto',
                          'tipo_transporte',
                          'precio_fob'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(5)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>2) ¿Como Ingresar el archivo "FOB"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "FOB"
                    </p>
                    <img src="{{asset('documents/fob.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 7 columnas:<br>
                        [
                          'n_variedad',
                          'semana',
                          'etiqueta',
                          'n_calibre',
                          'color',
                          'categoria',
                          'fob_kilo_salida'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(6)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>3) ¿Como Ingresar el archivo "ANTICIPOS"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "ANTICIPOS"
                    </p>
                    <img src="{{asset('documents/anticipos.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 5 columnas:<br>
                        [
                          'grupo',
                          'rut',
                          'n_productor',
                          'fecha',
                          'cantidad'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(7)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>4) ¿Como Ingresar el archivo "COMISIÓN"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "COMISIÓN"
                    </p>
                    <img src="{{asset('documents/comision.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 2 columnas:<br>
                        [
                          'productor',
                          'comision',
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(8)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>5) ¿Como Ingresar el archivo "FLETE-HUERTO"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "FLETE-HUERTO"
                    </p>
                    <img src="{{asset('documents/fletes.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 4 columnas:<br>
                        [
                          'grupo',
                          'rut',
                          'productor',
                          'tarifa'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(9)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>6) ¿Como Ingresar el archivo "MATERIALES"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "Materiales"
                    </p>
                    <img src="{{asset('documents/materiales.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 3 columnas:<br>
                        [
                          'c_embalaje',
                          'costo_por_caja_usd',
                          'descripcion'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(10)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>7) ¿Como Ingresar el archivo "COSTO PACKING"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "COSTO PACKING"
                    </p>
                    <img src="{{asset('documents/packing.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Subir archivo con las siguientes 6 columnas:<br>
                        [
                          'especie',
                          'variedad',
                          'n_productor',
                          'csg',
                          'kg',
                          'total_usd'
                      ]
                      </p>
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(11)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>8) ¿Como Ingresar el archivo "GASTO EXPORTACIÓN"?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "GASTO EXPORTACIÓN"
                    </p>
                    <img src="{{asset('documents/exportacion.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Ingresar Valores para los siguientes parametros:<br>
                        [
                          'Maritimo',
                          'Aereo',
                          'Terrestre' ]
                      </p>

                      <img src="{{asset('documents/exportacion2.png')}}" class="w-full px-8" alt="">
                    

                   
                  </div>
                </li>

                <li class="bg-white my-2 shadow-lg" x-data="accordion(12)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>¿Como generar una liquidación?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    x-ref="tab"
                    :style="handleToggle()"
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                  >
                    <p class="p-3 text-gray-900">
                      Paso 1: Ir a la sección "RESUMEN"
                    </p>
                    <img src="{{asset('documents/listaproductores.png')}}" class="w-full px-8" alt="">
                      <p class="p-3 text-gray-900">
                        Paso 2: Seleccionar el boton "GENERAR" del productor que se desea generar su liquidación<br>
                     
                      </p>


                   
                  </div>
                </li>



                {{-- 
                <li class="bg-white my-2 shadow-lg" x-data="accordion(2)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>How do I track my order?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                    x-ref="tab"
                    :style="handleToggle()"
                  >
                    <p class="p-3 text-gray-900">
                      Once shipped, you’ll get a confirmation email that includes a tracking number and additional information regarding tracking your order.
                    </p>
                  </div>
                </li>
                <li class="bg-white my-2 shadow-lg" x-data="accordion(3)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>What’s your return policy?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                    x-ref="tab"
                    :style="handleToggle()"
                  >
                    <p class="p-3 text-gray-900">
                      We allow the return of all items within 30 days of your original order’s date. If you’re interested in returning your items, send us an email with your order number and we’ll ship a return label.
                    </p>
                  </div>
                </li>
                <li class="bg-white my-2 shadow-lg" x-data="accordion(4)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>How do I make changes to an existing order?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                    x-ref="tab"
                    :style="handleToggle()"
                  >
                    <p class="p-3 text-gray-900">
                      Changes to an existing order can be made as long as the order is still in “processing” status. Please contact our team via email and we’ll make sure to apply the needed changes. If your order has already been shipped, we cannot apply any changes to it. If you are unhappy with your order when it arrives, please contact us for any changes you may require.
                    </p>
                  </div>
                </li>
                <li class="bg-white my-2 shadow-lg" x-data="accordion(5)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>What shipping options do you have?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                    x-ref="tab"
                    :style="handleToggle()"
                  >
                    <p class="p-3 text-gray-900">
                      For USA domestic orders we offer FedEx and USPS shipping.
                    </p>
                  </div>
                </li>
                <li class="bg-white my-2 shadow-lg" x-data="accordion(6)">
                  <h2
                    @click="handleClick()"
                    class="flex flex-row justify-between items-center font-semibold p-3 cursor-pointer"
                  >
                    <span>What payment methods do you accept?</span>
                    <svg
                      :class="handleRotate()"
                      class="fill-current text-purple-700 h-6 w-6 transform transition-transform duration-500"
                      viewBox="0 0 20 20"
                    >
                      <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                    </svg>
                  </h2>
                  <div
                    class="border-l-2 border-purple-600 overflow-hidden max-h-0 duration-500 transition-all"
                    x-ref="tab"
                    :style="handleToggle()"
                  >
                    <p class="p-3 text-gray-900">
                      Any method of payments acceptable by you. For example: We accept MasterCard, Visa, American Express, PayPal, JCB Discover, Gift Cards, etc.
                    </p>
                  </div>
                </li>comment --}}
              </ul>
            </div>
          </div>
        </main>
   
      <script>
        document.addEventListener('alpine:init', () => {
          Alpine.store('accordion', {
            tab: 0
          });
          
          Alpine.data('accordion', (idx) => ({
            init() {
              this.idx = idx;
            },
            idx: -1,
            handleClick() {
              this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
            },
            handleRotate() {
              return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
            },
            handleToggle() {
              return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
            }
          }));
        })
      </script>
             
            
</x-app-layout>
