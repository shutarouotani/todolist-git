<?php $subtasks = $task->subtasks()->orderBy('created_at', 'desc')->paginate(10); ?>
@if (count($subtasks) > 0)
    <table class="table table-striped">
        <thread>
            <tr class="info">
                <th>内容</th>
            </tr>
        </thread>
        @foreach ($subtasks as $subtask)
            <tbody>
                <tr>
                    <td>{{ $subtask->content }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
    
    {!! $subtasks->render() !!}
@endif