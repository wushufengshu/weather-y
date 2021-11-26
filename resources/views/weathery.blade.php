<x-app-layout>   
    <input type="hidden" id="app_id" value="{{env('OPENWEATHER_KEY')}}" >
    
    <div class="py-12 mx-3">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden    mb-4">  
                
                 
                <form action="/" method="GET">   
                    <div class="flex flex-row sm:col-span-3 items-stretch "> 
                        <input type="text" id="first-name" name="city_name" value = "{{ !empty(app('request')->input('city_name')) ? app('request')->input('city_name') : '' }}"
                        class="flex-shrink  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <span class="ml-3 sm:ml-3 flex-1">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                                <!-- Heroicon name: solid/check -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg> 
                            </button>
                        </span>
                    </div>
                </form> 
                
     


            </div>
            <div class="p-6 bg-blue-200 border-b border-2 border-blue-200 rounded-xl">
                <div class="flex flex-col  "> 
                    <div class="flex flex-row justify-between">
                        <p class=" ">{{ $currentWeather['name'] }}, {{$currentWeather['sys']['country']}}</p>

                            
                        <p class=" ">{{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
                    </div>
                    
                    <div class="flex justify-center px-3 my-10 ">
                          
                        <img src="http://openweathermap.org/img/wn/{{$currentWeather['weather'][0]['icon']}}@2x.png" alt="icon" class="flex-shrink-0">
                        <div class="flex flex-col place-items-center">
                            <div class="my-auto">
                                
                                <p class="text-5xl ">{{ $currentWeather['main']['temp'] }}<span class="text-3xl">&#8451;</span></p>
                                <p class="text-xl">{{ ucfirst($currentWeather['weather'][0]['description']) }}</p>
                                
                            </div>
                        </div> 
                    
                       
                    </div>
                    <div class="text-center text-sm "></div>
                </div>
                <ul class="grid grid-cols-5 grid-flow-col  gap-4">
                    @foreach($weatherForecast['list'] as $forecast )
                    <li class="grid grid-cols justify-center">
                        <div class="text-center text-sm">
                            {{ ucfirst(\Carbon\Carbon::createFromTimestamp($forecast['dt'])->format('D')) }}
                            <p>{{ \Carbon\Carbon::createFromTimestamp($forecast['dt'])->format('H:i') }}</p>
                        </div> 
                        <div>
                        <img src="http://openweathermap.org/img/wn/{{$forecast['weather'][0]['icon']}}.png" alt="icon" class="flex-shrink-0">
                        </div>
                        <div class="text-center text-sm">
                        {{ $forecast['main']['temp'] }}&#8451;
                        </div>
                    </li> 
                    @endforeach
                </ul>
            </div>
            <div class="p-6 bg-blue-200 border-b border-2 border-blue-200 rounded-xl mt-2">
                <p class="flex flex-row gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Places to go to!
                </p>
                <ul class="grid grid-cols  items-center m-2 p-2"> 
                    @foreach($siteList as $site) 
                    <li class="flex  justify-start mb-6">
                        <img
                            class="w-24 mr-5 object-contain"
                            src="{{$site[1][0]['prefix']}}original{{$site[1][0]['suffix']}}"
                        />
                        <div>
                            <h3 class="flex text-sm text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $site[0]['name'] }}
                            </h3>
                            <p class="flex text-sm  items-start text-gray-700 mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            {{ $site[2][0]['text'] }}
                            
                            </p>
                        </div> 
                    </li>   
                    @endforeach
                </ul> 
            </div>
        </div>
    </div> 
  
</x-app-layout>
