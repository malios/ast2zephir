namespace Malios;

abstract class Config
{
    public static config = [
        "doctrine": [
            "connection": [
                "odm_default": [
                    "server": "localhost",
                    "port": "3001",
                    "database": "",
                    "user": "",
                    "password": ""
                ]
            ],
            "configuration": [
                "odm_default": [
                    "generate_proxies": 2,
                    "generate_hydrators": 2,
                    "metadata_cache_driver": [
                        "redis": [
                            "host": "localhost",
                            "port": 6379,
                            "timeout": 42,
                            "namespace": "test"
                        ]
                    ]
                ]
            ]
        ]
    ];
}
