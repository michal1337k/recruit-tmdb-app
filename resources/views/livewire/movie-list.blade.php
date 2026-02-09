<div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Vote Average</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    @php
                        $translation = $movie->translations->firstWhere('locale', app()->getLocale());
                    @endphp
                    <td>{{ $translation?->title ?? $movie->title }}</td>

                    <td>{{ $movie->release_date }}</td>
                    <td>{{ $movie->vote_average }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movies->links() }}
</div>
