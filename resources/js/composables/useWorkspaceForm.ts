import { router, useForm, usePage } from '@inertiajs/vue3';

type RouteParams = string | number;
type FormOptions = Record<string, any>;

export function useWorkspaceForm<T extends object>(initialData: T) {
    const wsId = usePage().props.wsId as number;

    const form = useForm<T>(initialData);

    function buildRoute(routeName: string, path: RouteParams[] = []): string {
        return route(routeName, [wsId, ...path]);
    }

    function post(routeName: string, path: RouteParams[] = [], options: FormOptions = {}) {
        router.post(buildRoute(routeName, path), form.data(), options);
    }

    function patch(routeName: string, path: RouteParams[] = [], options: FormOptions = {}) {
        router.patch(buildRoute(routeName, path), form.data(), options);
    }

    function destroy(routeName: string, path: RouteParams[] = [], options: FormOptions = {}) {
        router.delete(buildRoute(routeName, path), options);
    }

    function get(routeName: string, path: RouteParams[] = [], options: FormOptions = {}) {
        router.get(buildRoute(routeName, path), options);
    }

    return {
        form,
        post,
        patch,
        destroy,
        get,
    };
}
