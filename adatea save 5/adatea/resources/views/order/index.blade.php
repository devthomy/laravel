<script>
    //    var orders = json($orders);
    //    console.log(orders);
    //
</script>

<x-app-layout>
    <div class="flex items-center justify-center py-12 px-6">
        <div class="w-full max-w-4xl p-4">
            <x-slot name="header">
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Liste des commandes') }}
                        </h2>
                    </div>
                    <div>

                        <form method="GET" action="{{ route('order.index') }}" class="flex items-center">
                            <a href="{{ route('order.index') }}" class="btn btn-secondary mr-2">
                                <img src="{{ asset('reset.png') }}" alt="Réinitialiser" style="width: 25px; height: 25px;" />
                            </a>

                            <select name="client_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Sélectionnez un client</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->client_id }}" {{ request('client_id') == $client->client_id ? 'selected' : '' }}>
                                    {{ $client->client_id }} - {{ $client->first_name }} {{ $client->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </form>


                    </div>
                </div>
            </x-slot>







            <table class="w-full divide-y divide-gray-200">
                <thead style="background-color: #6875F5;">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Client <!-- Adapté pour les commandes -->
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Date <!-- Adapté pour les commandes -->
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Montant <!-- Adapté pour les commandes -->
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order) <!-- Adapté pour les commandes -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->client->first_name }} {{ $order->client->last_name }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$order->date}} <!-- Formatage de la date -->
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{$order->amount}} €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('order.show', $order) }}" style="color: #6875F5;">Détails</a> <!-- Modifié pour pointer vers le détail de la commande -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>