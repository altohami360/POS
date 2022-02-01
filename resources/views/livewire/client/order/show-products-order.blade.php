<div>
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($order_items as $item)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $item->product->name }}
                </td>
                <td class="project_progress">
                    {{ $item->price }}
                </td>
                <td>
                    {{ $item->quantity }}
                </td>
            </tr>
            @empty
            <h3>NO Data</h3>
            @endforelse
        </tbody>
    </table>
</div>
