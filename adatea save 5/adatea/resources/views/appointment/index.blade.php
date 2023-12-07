<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<script type="text/javascript">
    var userId = @json($userId);
    console.log('L\'ID de l\'utilisateur connecté est : ' + userId);

    var userEmail = @json($userEmail);
    console.log('L\'e-mail de l\'utilisateur connecté est : ' + userEmail);

    var employerId = @json($employerId);
    console.log('L\'ID de l\'employeur correspondant est : ' + employerId);
</script>




<x-app-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 min-w-full">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Liste des rendez-vous') }}
                        </h2>
                    </x-slot>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Ci-dessous, vous trouverez une liste de tous vos rendez-vous planifiés.
                    </p>

                    <div class="my-6 overflow-x-auto">
                            <table class="w-full min-w-full divide-y divide-gray-200">
                                <thead style="background-color: #6875F5;">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        N° Rendez-vous
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Date et Heure
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Lieu
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Statut
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$appointment->appointment_id}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$appointment->client->first_name}} (ID: {{$appointment->client_id ??
                                            'N/A'}})
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{date('d/m/Y H:i', strtotime($appointment->date_time))}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{$appointment->location}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div style="
                                        @if($appointment->status === 'Planned')
                                            background-color: rgba(255, 255, 0, 0.75); /* Jaune avec 75% d'opacité */
                                        @elseif($appointment->status === 'Realized')
                                            background-color: rgba(0, 128, 0, 0.75); /* Vert avec 75% d'opacité */
                                        @elseif($appointment->status === 'Canceled')
                                            background-color: rgba(255, 0, 0, 0.75); /* Rouge avec 75% d'opacité */
                                        @endif
                                        border-radius: 10px;
                                        padding: 4px 12px;
                                        width: 100px; /* Largeur fixe de 100 pixels */
                                        text-align: center; /* Centrer le texte horizontalement */
                                        display: inline-block;">
                                            @if($appointment->status === 'Planned')
                                            Planifié
                                            @elseif($appointment->status === 'Realized')
                                            Réalisé
                                            @elseif($appointment->status === 'Canceled')
                                            Annulé
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('appointments.show', ['appointment' => $appointment->appointment_id]) }}"
                                            style="color: #6875F5;">Voir plus</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>