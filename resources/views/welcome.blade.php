<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lottery API Documentation</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css" />
    <style>
        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>
<body>

<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
<script>
    window.onload = () => {
        window.ui = SwaggerUIBundle({
            spec: {
                openapi: "3.0.3",
                info: {
                    title: "Lottery API",
                    version: "1.0.0",
                    description: "API для создания чеков Lottery"
                },
                servers: [
                    {
                        url: "https://your-domain.com",
                        description: "Production"
                    }
                ],
                paths: {
                    "/api/lottery/receipt": {
                        post: {
                            tags: ["Lottery Receipt"],
                            summary: "Создание чека",
                            security: [
                                {
                                    LotteryToken: []
                                }
                            ],
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
                                                type: {
                                                    type: "string",
                                                    example: "retail"
                                                },
                                                shop: {
                                                    type: "string",
                                                    example: "Shop-01"
                                                },
                                                pos: {
                                                    type: "string",
                                                    example: "POS-01"
                                                },
                                                cashier: {
                                                    type: "string",
                                                    example: "Ali"
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
                                    description: "Чек успешно создан",
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
                                    description: "Invalid token"
                                },
                                "422": {
                                    description: "Validation error"
                                }
                            }
                        }
                    }
                },
                components: {
                    securitySchemes: {
                        LotteryToken: {
                            type: "apiKey",
                            in: "header",
                            name: "X-LOTTERY-TOKEN"
                        }
                    }
                }
            },
            dom_id: "#swagger-ui",
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis
            ],
            layout: "BaseLayout"
        });
    };
</script>

</body>
</html>
