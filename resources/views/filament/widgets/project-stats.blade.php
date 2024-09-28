<div class="space-y-4">
    <ul>
        @foreach ($projectsWithDaysLeft as $project)
            <li class="p-4 bg-white shadow rounded">
                <strong>{{ $project['name'] }}</strong><br>
                <span>Days left: {{ $project['days_left'] }}</span><br>
                <span>Progress: {{ $project['progress'] }}%</span>
            </li>
        @endforeach
    </ul>
</div>
