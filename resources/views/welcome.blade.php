<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lottery API Documentation</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css" />
    <style>
        body { margin: 0; background: #fafafa; }
    </style>
</head>
<body>

<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
<script>
window.onload = () => {
    SwaggerUIBundle({
        spec: {
            openapi: "3.0.3",
            info: {
                title: "Lottery API",
                version: "1.0.0",
                description: "Receipt creation resolved by X-Token."
            },
            paths: {
                "/api/lottery/receipt": {
                    post: {
                        tags: ["Lottery Receipt"],
                        summary: "Создание чека",
                        security: [{ XTokenAuth: [] }],
                        requestBody: {
                            required: true,
                            content: {
                                "application/json": {
                                    schema: {
                                        type: "object",
                                        required: ["total"],
                                        properties: {

                                            no: {
                                                type: "integer",
                                                example: 15
                                            },

                                            receipt_no: {
                                                type: "string",
                                                example: "RCP-2026-0001"
                                            },

                                            receipt_barcode: {
                                                type: "string",
                                                example: "1234567890123"
                                            },

                                            client: {
                                                type: "string",
                                                nullable: true,
                                                example: "998901234567"
                                            },

                                            total: {
                                                type: "number",
                                                format: "decimal",
                                                example: 25000.00
                                            }

                                        }
                                    }
                                }
                            }
                        },
                        responses: {
                            "201": {
                                description: "Receipt created",
                                content: {
                                    "application/json": {
                                        schema: {
                                            type: "object",
                                            properties: {
                                                status: {
                                                    type: "string",
                                                    example: "success"
                                                },
                                                id: {
                                                    type: "integer",
                                                    example: 21
                                                },
                                                receipt_no: {
                                                    type: "string",
                                                    example: "RCP-2026-0001"
                                                },
                                                total: {
                                                    type: "number",
                                                    example: 25000.00
                                                },
                                                created_at: {
                                                    type: "string",
                                                    format: "date-time",
                                                    example: "2026-02-13T13:05:00Z"
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            "401": {
                                description: "Missing X-Token"
                            },
                            "402": {
                                description: "Invalid X-Token"
                            },
                            
                        }
                    }
                }
            },
            components: {
                securitySchemes: {
                    XTokenAuth: {
                        type: "apiKey",
                        in: "header",
                        name: "X-TOKEN"
                    }
                }
            }
        },
        dom_id: "#swagger-ui",
        deepLinking: true,
        presets: [SwaggerUIBundle.presets.apis],
        layout: "BaseLayout"
    });
};
</script>

</body>
</html>
