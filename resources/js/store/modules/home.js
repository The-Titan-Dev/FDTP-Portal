import axios from "axios";

export default {
    state: {
        user_info: {
            "status": "success",
            "code": 200,
            "message": "User Authenticated",
            "data": {
                "status": 3,
                "message": "User Authenticated",
                "data": {
                    "emp_id": 174438,
                    "last_name": "CASILE",
                    "first_name": "ARNIEL",
                    "middle_name": "ESCLAMADO",
                    "position": "SPECIALIST 1",
                    "section_code": "MIT",
                    "photo": null,
                    "token": {
                        "id": 1,
                        "emp_id": 174438,
                        "auth_token": "bBKILwCqhPoIm9TJ61Nd9NrSDRYiYFO0oMQag3hz7wuHlRrTyL9I5X8BVfAoyzyA",
                        "access_token_id": 1,
                        "created_at": "2021-02-10T00:24:02.000000Z",
                        "updated_at": "2021-02-10T00:24:02.000000Z",
                        "access_token": "ksPemf07oKyDr5isl3Hujs0QvHf3Ma9CoCJSjH0CBBtKdfkdpGNdsuiwC0wnP8h3",
                        "system_id": 1
                    },
                    "systems": [
                        {
                            "id": 1,
                            "name": "TMS",
                            "abbreviation": "-",
                            "reference_code": "00001",
                            "reference_number": "00002",
                            "description": "trial",
                            "url": "http://10.164.58.52/tms/public/api/user/login-auth",
                            "date_deployed": "2020-08-01",
                            "status": "active",
                            "section_owner": "TDM-PC",
                            "section_owner_id": 12,
                            "system_access_id": 1,
                            "roles": [
                                {
                                    "id": 1,
                                    "system_access_id": 1,
                                    "role_id": 1,
                                    "created_at": "2021-02-10T00:26:31.000000Z",
                                    "updated_at": "2021-02-10T00:26:31.000000Z",
                                    "system_id": 1,
                                    "role": "Admin",
                                    "description": "trial",
                                    "deleted_at": null
                                }
                            ],
                            "access_token": {
                                "id": 1,
                                "access_token": "ksPemf07oKyDr5isl3Hujs0QvHf3Ma9CoCJSjH0CBBtKdfkdpGNdsuiwC0wnP8h3",
                                "system_id": 1,
                                "created_at": "2021-02-10T00:24:02.000000Z",
                                "updated_at": "2021-02-10T00:24:02.000000Z"
                            }
                        },
                        {
                            "id": 2,
                            "name": "ATS",
                            "abbreviation": "-",
                            "reference_code": "00002",
                            "reference_number": "00003",
                            "description": "trial",
                            "url": "http://10.164.58.52/tms/public/api/user/login-auth",
                            "date_deployed": "2020-08-01",
                            "status": "active",
                            "section_owner": "ASSY3",
                            "section_owner_id": 22,
                            "system_access_id": 2,
                            "roles": [
                                {
                                    "id": 2,
                                    "system_access_id": 2,
                                    "role_id": 2,
                                    "created_at": "2021-02-10T01:30:32.000000Z",
                                    "updated_at": "2021-02-10T01:30:32.000000Z",
                                    "system_id": 2,
                                    "role": "User",
                                    "description": "sample",
                                    "deleted_at": null
                                },
                                {
                                    "id": 4,
                                    "system_access_id": 2,
                                    "role_id": 4,
                                    "created_at": null,
                                    "updated_at": null,
                                    "system_id": 2,
                                    "role": "Staff",
                                    "description": "test",
                                    "deleted_at": null
                                }
                            ],
                            "access_token": {
                                "id": 3,
                                "access_token": "AY0QZswXh2Nyd2zASnSrecT6obaSm1Iq5wqdqVyHe3wRbIA9UsUdJfRlnPfkmZV1",
                                "system_id": 2,
                                "created_at": "2021-02-11T07:10:23.000000Z",
                                "updated_at": "2021-02-11T07:10:23.000000Z"
                            }
                        }
                    ]
                }
            }
        }
    },
    mutations: {
   
    },
    actions: {
     
    },
    getters: {
        user_info: state => state.user_info
    }
};
