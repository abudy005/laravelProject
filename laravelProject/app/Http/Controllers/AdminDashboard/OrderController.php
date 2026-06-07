<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List orders, optionally filtered by status, newest first, paginated.
    public function index(Request $request)
    {
        $status = $request->status;

        $orders = Order::with('user')
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // keep ?status= when paging

        $statuses = Order::STATUSES;

        return view('admin.orders.index', compact('orders', 'statuses', 'status'));
    }

    // Show one order with its items + customer.
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        $statuses = Order::STATUSES;

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    // Move an order to a new status.
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:New,Accepted,Cancelled,Onshipping,Completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully.');
    }
}
