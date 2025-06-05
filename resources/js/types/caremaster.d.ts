export interface Company {
    id: number;
    name: string;
    abn: string;
    email: string;
    address: string;
}

export interface Employee {
    id: number;
    company_id: number;
    first_name: string;
    last_name: string;
    email: string;
    address: string;
}
