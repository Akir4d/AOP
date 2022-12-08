export interface DbConfig {
    DSN?: string;
    hostname: string;
    username: string;
    password: string;
    database: string;
    DBDriver: string;
    DBPrefix: string;
    pConnect: boolean;
    charset: string;
    DBCollat: string;
    swapPre?: string;
    encrypt?: boolean;
    compress?: boolean;
    strictOn?: boolean;
    port?: number;
}