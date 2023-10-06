import { useState } from "react";
import { router } from '@inertiajs/react';
import { Link, Head } from '@inertiajs/react';

export default function Suggestions({ suggestion, participantCount }) {
    const [participants, setParticipants] = useState(participantCount)

    const partialReload = () => {
        router.reload({ only: ['suggestion', 'participantCount'] })
    }

    return (
        <>
            <Head title="Suggestions" />
            <div className="container mx-auto pt-4">
                <input type="number" className="form-input" value={participants} onChange={e => setParticipants(e.target.value)} />
                <Link href={`${window.location.href}?participants=${participants}` } only={['suggestion']}>Show active</Link>
                <div className="flex flex-col">
                    <span>{ suggestion.activity }</span>
                    <span>Great for: {suggestion.participants} { suggestion.participants === 1 ? 'person' : 'people' }</span>
                </div>
            </div>
        </>
    );
}
