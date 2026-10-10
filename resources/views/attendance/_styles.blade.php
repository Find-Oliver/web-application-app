<style>
    .attendance-toolbar,
    .attendance-actions,
    .attendance-form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .attendance-toolbar {
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .attendance-table-wrap,
    .attendance-form {
        background: var(--panel);
        border: 1px solid var(--panel-border);
        border-radius: 8px;
    }

    .attendance-table-wrap {
        overflow-x: auto;
    }

    .attendance-pagination svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .attendance-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .attendance-table th,
    .attendance-table td {
        padding: 13px 16px;
        border-bottom: 1px solid var(--panel-border);
        text-align: left;
        vertical-align: middle;
    }

    .attendance-table th {
        background: #f8fafc;
        color: var(--muted);
        font-size: 12px;
        text-transform: uppercase;
    }

    .attendance-table tr:last-child td {
        border-bottom: 0;
    }

    .attendance-form {
        max-width: 760px;
        padding: 24px;
    }

    .attendance-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .attendance-field {
        min-width: 0;
    }

    .attendance-field.wide {
        grid-column: 1 / -1;
    }

    .attendance-field label {
        display: block;
        margin-bottom: 7px;
        color: var(--text);
        font-size: 13px;
        font-weight: 600;
    }

    .attendance-field input,
    .attendance-field select,
    .attendance-field textarea {
        width: 100%;
        min-height: 42px;
        padding: 9px 11px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background: #fff;
        color: var(--text);
        font: inherit;
    }

    .attendance-field textarea {
        min-height: 90px;
        resize: vertical;
    }

    .attendance-field input:focus,
    .attendance-field select:focus,
    .attendance-field textarea:focus {
        outline: 2px solid rgba(79, 70, 229, 0.25);
        border-color: var(--primary);
    }

    .attendance-error {
        margin-top: 5px;
        color: var(--danger);
        font-size: 12px;
    }

    .attendance-form-actions {
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid var(--panel-border);
    }

    .attendance-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 13px;
        border: 1px solid var(--panel-border);
        border-radius: 6px;
        background: white;
        color: var(--text);
        cursor: pointer;
        font: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .attendance-button.primary {
        border-color: transparent;
        background: var(--primary);
        color: white;
    }

    .attendance-button.primary:hover {
        background: var(--primary-dark);
        color: white;
    }

    .attendance-button.danger {
        border-color: transparent;
        background: var(--danger);
        color: white;
    }

    .attendance-status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 999px;
        background: #dcfce7;
        color: #166534;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .attendance-status.absent {
        background: #fee2e2;
        color: #991b1b;
    }

    .attendance-status.late,
    .attendance-status.half-day {
        background: #fef3c7;
        color: #92400e;
    }

    .attendance-status.on-leave {
        background: #e0f2fe;
        color: #075985;
    }

    @media (max-width: 640px) {
        .attendance-form {
            padding: 18px;
        }

        .attendance-form-grid {
            grid-template-columns: 1fr;
        }

        .attendance-field.wide {
            grid-column: auto;
        }

        .attendance-form-actions {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
