import { User } from '../Users';

export interface Task {
    id: number;
    title: string;
    description: string;
    status: 'pending' | 'in_progress' | 'completed' | 'cancelled';
    due_date: string;
    created_at: string;
    updated_at: string;
    signees?: User[];
}

export type TaskDraft = Omit<Task, 'id' | 'created_at' | 'updated_at'>;
