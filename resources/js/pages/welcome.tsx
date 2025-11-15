import { dashboard, login, register } from '@/routes';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome({
    canRegister = true,
}: {
    canRegister?: boolean;
}) {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome" />
            <div className="flex min-h-screen flex-col items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 p-6 dark:from-slate-950 dark:to-slate-900">
                <div className="w-full max-w-md space-y-8">
                    {/* Header */}
                    <div className="text-center">
                        <h1 className="text-4xl font-bold text-slate-900 dark:text-white">
                            Welcome
                        </h1>
                        <p className="mt-2 text-slate-600 dark:text-slate-400">
                            {auth.user
                                ? 'You are logged in'
                                : 'Get started with your account'}
                        </p>
                    </div>

                    {/* Action Buttons */}
                    <div className="space-y-3">
                        {auth.user ? (
                            <Link
                                href={dashboard()}
                                className="block w-full rounded-lg bg-blue-600 px-6 py-3 text-center font-semibold text-white transition-colors hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600"
                            >
                                Go to Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={login()}
                                    className="block w-full rounded-lg bg-blue-600 px-6 py-3 text-center font-semibold text-white transition-colors hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600"
                                >
                                    Log In
                                </Link>
                                {canRegister && (
                                    <Link
                                        href={register()}
                                        className="block w-full rounded-lg border-2 border-slate-300 px-6 py-3 text-center font-semibold text-slate-900 transition-colors hover:bg-slate-50 dark:border-slate-600 dark:text-white dark:hover:bg-slate-800"
                                    >
                                        Sign Up
                                    </Link>
                                )}
                            </>
                        )}
                    </div>

                    {/* Info */}
                    <div className="text-center text-sm text-slate-600 dark:text-slate-400">
                        <p>
                            All UI is served from React on{' '}
                            <code className="rounded bg-slate-200 px-2 py-1 dark:bg-slate-800">
                                :5173
                            </code>
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}
