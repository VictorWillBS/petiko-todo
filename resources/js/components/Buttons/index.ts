export const variant = {
    success: 'bg-green-200 text-green-700 transition hover:bg-green-700 hover:text-green-200',
    danger: 'bg-red-200 text-red-700 transition hover:bg-red-700 hover:text-red-200',
    warning: 'bg-yellow-200 text-yellow-700 transition hover:bg-yellow-700 hover:text-yellow-200',
    violet: 'bg-violet-200 text-violet-700 transition hover:bg-violet-700 hover:text-violet-200',
    info: 'bg-blue-200 text-blue-700 transition hover:bg-blue-700 hover:text-blue-200',
    light: 'bg-neutral-200 text-neutral-700 transition hover:bg-neutral-700 hover:text-neutral-200',
}

export type VariantType = keyof typeof variant;
