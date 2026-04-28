<h1>Expenses</h1>
@foreach ($expenses as $expense)
    <div>{{$expense->title}}</div>
    <div>{{$expense->formatted_amount}}</div>
    <div>{{$expense->amount_label}}</div>
@endforeach

