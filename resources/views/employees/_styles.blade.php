<style>
    .employee-toolbar,
    .employee-actions,
    .employee-form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .employee-toolbar {
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .employee-table-wrap,
    .employee-form,
    .employee-details {
        background: var(--panel);
        border: 1px solid var(--panel-border);
        border-radius: 18px;
        box-shadow: var(--shadow);
    }

    .employee-table-wrap {
        overflow-x: auto;
    }

    .employee-table {
        width: 100%;
        min-width: 820px;
        border-collapse: collapse;
    }

    .employee-table th,
    .employee-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--panel-border);
        text-align: left;
        vertical-align: middle;
    }

    .employee-table th {
        background: #f8fafc;
        color: var(--muted);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .employee-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .employee-form {
        max-width: 980px;
        padding: 24px;
    }

    .employee-form-grid,
    .employee-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .employee-field {
        min-width: 0;
    }

    .employee-field.wide {
        grid-column: 1 / -1;
    }

    .employee-field label,
    .employee-detail dt {
        display: block;
        margin-bottom: 7px;
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
    }

    .employee-field input,
    .employee-field select,
    .employee-field textarea {
        width: 100%;
        min-height: 42px;
        padding: 10px 12px;
        border: 1px solid #dfe5ec;
        border-radius: 10px;
        background: #fff;
        color: var(--text);
        font: inherit;
    }

    .employee-field textarea {
        min-height: 90px;
        resize: vertical;
    }

    .employee-form-actions {
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid var(--panel-border);
    }

    .employee-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 10px 16px;
        border: 1px solid transparent;
        border-radius: 10px;
        background: var(--primary);
        color: white;
        cursor: pointer;
        font: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .employee-button:hover {
        background: var(--primary-dark);
        color: white;
    }

    .employee-button.secondary {
        border-color: var(--panel-border);
        background: white;
        color: var(--text);
    }

    .employee-button.secondary:hover {
        background: #f8fafc;
    }

    .employee-button.danger {
        background: var(--danger);
    }

    .employee-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        background: #e0f2fe;
        color: #075985;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .employee-status.inactive,
    .employee-status.terminated {
        background: #fee2e2;
        color: #991b1b;
    }

    .employee-status.on-leave {
        background: #fef3c7;
        color: #92400e;
    }

    .employee-details {
        max-width: 980px;
        padding: 24px;
    }

    .employee-detail {
        padding-bottom: 14px;
        border-bottom: 1px solid var(--panel-border);
    }

    .employee-detail dt {
        color: var(--muted);
    }

    .employee-detail dd {
        margin: 0;
        overflow-wrap: anywhere;
    }

    .employee-error {
        margin-top: 5px;
        color: var(--danger);
        font-size: 12px;
    }

    @media (max-width: 640px) {
        .employee-form,
        .employee-details {
            padding: 18px;
        }

        .employee-form-grid,
        .employee-detail-grid {
            grid-template-columns: 1fr;
        }

        .employee-field.wide {
            grid-column: auto;
        }

        .employee-form-actions {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
