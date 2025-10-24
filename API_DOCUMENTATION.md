# SMK Negeri 4 Kota Bogor - API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
All API endpoints are currently public (no authentication required).

## Response Format
All API responses follow this format:
```json
{
    "success": true/false,
    "message": "Description message",
    "data": {...},
    "count": 0
}
```

---

## 📋 TABLE OF CONTENTS

### 1. [Users API](#users-api)
### 2. [Petugas API](#petugas-api)
### 3. [Kategori API](#kategori-api)
### 4. [Posts API](#posts-api)
### 5. [Profiles API](#profiles-api)
### 6. [Galeries API](#galeries-api)
### 7. [Fotos API](#fotos-api)
### 8. [Jurusan Activities API](#jurusan-activities-api)
### 9. [School Galleries API](#school-galleries-api)
### 10. [Complex Relationship APIs](#complex-relationship-apis)
### 11. [Utility APIs](#utility-apis)

---

## 👥 USERS API

### Get All Users
```http
GET /api/users
```

### Get User by ID
```http
GET /api/users/{id}
```

### Create User
```http
POST /api/users
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

### Update User
```http
PUT /api/users/{id}
Content-Type: application/json

{
    "name": "John Updated",
    "email": "john.updated@example.com",
    "password": "newpassword123"
}
```

### Delete User
```http
DELETE /api/users/{id}
```

### Get User's Posts
```http
GET /api/users/{id}/posts
```

---

## 👨‍💼 PETUGAS API

### Get All Petugas
```http
GET /api/petugas
```

### Get Petugas by ID
```http
GET /api/petugas/{id}
```

### Create Petugas
```http
POST /api/petugas
Content-Type: application/json

{
    "username": "admin1",
    "email": "admin1@smkn4bogor.sch.id",
    "password": "password123"
}
```

### Update Petugas
```http
PUT /api/petugas/{id}
Content-Type: application/json

{
    "username": "admin1_updated",
    "email": "admin1.updated@smkn4bogor.sch.id",
    "password": "newpassword123"
}
```

### Delete Petugas
```http
DELETE /api/petugas/{id}
```

### Get Petugas's Posts
```http
GET /api/petugas/{id}/posts
```

---

## 📂 KATEGORI API

### Get All Kategori
```http
GET /api/kategori
```

### Get Kategori by ID
```http
GET /api/kategori/{id}
```

### Create Kategori
```http
POST /api/kategori
Content-Type: application/json

{
    "judul": "Berita Sekolah"
}
```

### Update Kategori
```http
PUT /api/kategori/{id}
Content-Type: application/json

{
    "judul": "Berita Sekolah Updated"
}
```

### Delete Kategori
```http
DELETE /api/kategori/{id}
```

### Get Kategori's Posts
```http
GET /api/kategori/{id}/posts
```

---

## 📰 POSTS API

### Get All Posts
```http
GET /api/posts
```

### Get Post by ID
```http
GET /api/posts/{id}
```

### Create Post
```http
POST /api/posts
Content-Type: application/json

{
    "judul": "Judul Artikel",
    "isi": "Isi artikel yang lengkap...",
    "status": "published",
    "kategori_id": 1,
    "petugas_id": 1
}
```

### Update Post
```http
PUT /api/posts/{id}
Content-Type: application/json

{
    "judul": "Judul Artikel Updated",
    "isi": "Isi artikel yang diperbarui...",
    "status": "draft",
    "kategori_id": 2,
    "petugas_id": 1
}
```

### Delete Post
```http
DELETE /api/posts/{id}
```

### Get Post's Galeries
```http
GET /api/posts/{id}/galeries
```

---

## 👤 PROFILES API

### Get All Profiles
```http
GET /api/profiles
```

### Get Profile by ID
```http
GET /api/profiles/{id}
```

### Create Profile
```http
POST /api/profiles
Content-Type: application/json

{
    "judul": "Profil SMK Negeri 4",
    "isi": "Deskripsi lengkap tentang SMK Negeri 4 Kota Bogor..."
}
```

### Update Profile
```http
PUT /api/profiles/{id}
Content-Type: application/json

{
    "judul": "Profil SMK Negeri 4 Updated",
    "isi": "Deskripsi yang diperbarui..."
}
```

### Delete Profile
```http
DELETE /api/profiles/{id}
```

---

## 🖼️ GALERIES API

### Get All Galeries
```http
GET /api/galeries
```

### Get Galery by ID
```http
GET /api/galeries/{id}
```

### Create Galery
```http
POST /api/galeries
Content-Type: application/json

{
    "post_id": 1,
    "position": 1,
    "status": 1,
    "category": "umum"
}
```

### Update Galery
```http
PUT /api/galeries/{id}
Content-Type: application/json

{
    "post_id": 2,
    "position": 2,
    "status": 1,
    "category": "pplg"
}
```

### Delete Galery
```http
DELETE /api/galeries/{id}
```

### Get Galery's Fotos
```http
GET /api/galeries/{id}/fotos
```

### Get Galeries by Category
```http
GET /api/galeries/category/{category}
```
Categories: `umum`, `pplg`, `tjkt`, `tpfl`, `to`, `transforkrab`

---

## 📸 FOTOS API

### Get All Fotos
```http
GET /api/fotos
```

### Get Foto by ID
```http
GET /api/fotos/{id}
```

### Create Foto
```http
POST /api/fotos
Content-Type: application/json

{
    "judul": "Foto Kegiatan",
    "file": "kegiatan1.jpg",
    "galery_id": 1
}
```

### Update Foto
```http
PUT /api/fotos/{id}
Content-Type: application/json

{
    "judul": "Foto Kegiatan Updated",
    "file": "kegiatan1_updated.jpg",
    "galery_id": 2
}
```

### Delete Foto
```http
DELETE /api/fotos/{id}
```

### Create Multiple Fotos
```http
POST /api/fotos/multiple
Content-Type: application/json

{
    "galery_id": 1,
    "fotos": [
        {
            "judul": "Foto 1",
            "file": "foto1.jpg"
        },
        {
            "judul": "Foto 2",
            "file": "foto2.jpg"
        }
    ]
}
```

---

## 🎓 JURUSAN ACTIVITIES API

### Get All Jurusan Activities
```http
GET /api/jurusan-activities
```

### Get Jurusan Activity by ID
```http
GET /api/jurusan-activities/{id}
```

### Create Jurusan Activity
```http
POST /api/jurusan-activities
Content-Type: application/json

{
    "jurusan": "PPLG",
    "title": "Workshop Programming",
    "description": "Workshop programming untuk siswa PPLG",
    "image_path": "workshop.jpg",
    "activity_type": "workshop",
    "activity_date": "2025-01-15",
    "is_active": true
}
```

### Update Jurusan Activity
```http
PUT /api/jurusan-activities/{id}
Content-Type: application/json

{
    "jurusan": "TJKT",
    "title": "Workshop Networking",
    "description": "Workshop networking untuk siswa TJKT",
    "image_path": "networking.jpg",
    "activity_type": "workshop",
    "activity_date": "2025-01-20",
    "is_active": true
}
```

### Delete Jurusan Activity
```http
DELETE /api/jurusan-activities/{id}
```

### Get Activities by Jurusan
```http
GET /api/jurusan-activities/jurusan/{jurusan}
```
Jurusan values: `PPLG`, `TJKT`, `TPFL`, `TO`

---

## 🏫 SCHOOL GALLERIES API

### Get All School Galleries
```http
GET /api/school-galleries
```

### Get School Gallery by ID
```http
GET /api/school-galleries/{id}
```

### Create School Gallery
```http
POST /api/school-galleries
Content-Type: application/json

{
    "title": "Galeri Sekolah",
    "description": "Galeri kegiatan sekolah",
    "image_path": "school_gallery.jpg",
    "category": "umum",
    "is_active": true
}
```

### Update School Gallery
```http
PUT /api/school-galleries/{id}
Content-Type: application/json

{
    "title": "Galeri Sekolah Updated",
    "description": "Galeri kegiatan sekolah yang diperbarui",
    "image_path": "school_gallery_updated.jpg",
    "category": "pplg",
    "is_active": true
}
```

### Delete School Gallery
```http
DELETE /api/school-galleries/{id}
```

---

## 🔗 COMPLEX RELATIONSHIP APIs

### Get All Data with Relationships
```http
GET /api/relationships/all-data
```

### Get School Data Structure
```http
GET /api/relationships/school-structure
```

### Get Data by Relationships
```http
GET /api/relationships/data-by-relationships
```

### Get Dashboard Summary
```http
GET /api/relationships/dashboard-summary
```

### Get Table Relationships
```http
GET /api/relationships/table-relationships
```

---

## 🎯 SPECIALIZED APIs

### Get Users with Posts
```http
GET /api/specialized/users-with-posts
```

### Get Petugas with Posts and Kategori
```http
GET /api/specialized/petugas-with-posts-kategori
```

### Get Kategori with Posts and Petugas
```http
GET /api/specialized/kategori-with-posts-petugas
```

### Get Posts with All Relations
```http
GET /api/specialized/posts-with-all-relations
```

### Get Galeries with All Relations
```http
GET /api/specialized/galeries-with-all-relations
```

### Get Fotos with All Relations
```http
GET /api/specialized/fotos-with-all-relations
```

---

## 🔧 COMPLEX CREATION APIs

### Create Post with Galery and Fotos
```http
POST /api/complex/post-with-galery-fotos
Content-Type: application/json

{
    "post": {
        "judul": "Artikel dengan Galeri",
        "isi": "Isi artikel...",
        "status": "published",
        "kategori_id": 1,
        "petugas_id": 1
    },
    "galery": {
        "position": 1,
        "status": 1
    },
    "fotos": [
        {
            "judul": "Foto 1",
            "file": "foto1.jpg"
        },
        {
            "judul": "Foto 2",
            "file": "foto2.jpg"
        }
    ]
}
```

### Create Multiple Fotos
```http
POST /api/complex/multiple-fotos
Content-Type: application/json

{
    "galery_id": 1,
    "fotos": [
        {
            "judul": "Foto 1",
            "file": "foto1.jpg"
        },
        {
            "judul": "Foto 2",
            "file": "foto2.jpg"
        }
    ]
}
```

---

## 🛠️ UTILITY APIs

### Get Database Statistics
```http
GET /api/utility/database-stats
```

### Get All Data Simple
```http
GET /api/utility/all-data-simple
```

### Search in Table
```http
GET /api/utility/search/{table}?q=search_term&limit=10
```
Supported tables: `users`, `posts`, `galeries`

### Get Table Count
```http
GET /api/utility/count/{table}
```
Supported tables: `users`, `petugas`, `kategori`, `posts`, `profiles`, `galeries`, `fotos`, `jurusan-activities`, `school-galleries`

---

## 📊 LEGACY ROUTES (Backward Compatibility)

All the original routes are still available for backward compatibility:

```http
GET /api/users
GET /api/petugas
GET /api/kategori
GET /api/posts
GET /api/profiles
GET /api/galeries
GET /api/fotos
GET /api/all-data-with-relations
GET /api/school-data-structure
GET /api/data-by-relationships
GET /api/dashboard-summary
GET /api/table-relationships
GET /api/database-stats
GET /api/all-data-simple
GET /api/users-with-posts
GET /api/petugas-with-posts-kategori
GET /api/kategori-with-posts-petugas
GET /api/posts-with-all-relations
GET /api/galeries-with-all-relations
GET /api/fotos-with-all-relations
POST /api/users
POST /api/petugas
POST /api/kategori
POST /api/posts
POST /api/profiles
POST /api/galeries
POST /api/fotos
POST /api/posts-with-galery-fotos
POST /api/multiple-fotos
```

---

## 🧪 POSTMAN COLLECTION

### Import this collection into Postman:

1. Open Postman
2. Click "Import"
3. Copy and paste the following JSON:

```json
{
    "info": {
        "name": "SMK Negeri 4 Kota Bogor API",
        "description": "Complete API collection for SMK Negeri 4 Kota Bogor School Gallery System",
        "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    },
    "variable": [
        {
            "key": "base_url",
            "value": "http://localhost:8000/api",
            "type": "string"
        }
    ],
    "item": [
        {
            "name": "Users",
            "item": [
                {
                    "name": "Get All Users",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/users",
                            "host": ["{{base_url}}"],
                            "path": ["users"]
                        }
                    }
                },
                {
                    "name": "Get User by ID",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/users/1",
                            "host": ["{{base_url}}"],
                            "path": ["users", "1"]
                        }
                    }
                },
                {
                    "name": "Create User",
                    "request": {
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"name\": \"John Doe\",\n    \"email\": \"john@example.com\",\n    \"password\": \"password123\"\n}"
                        },
                        "url": {
                            "raw": "{{base_url}}/users",
                            "host": ["{{base_url}}"],
                            "path": ["users"]
                        }
                    }
                },
                {
                    "name": "Update User",
                    "request": {
                        "method": "PUT",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"name\": \"John Updated\",\n    \"email\": \"john.updated@example.com\",\n    \"password\": \"newpassword123\"\n}"
                        },
                        "url": {
                            "raw": "{{base_url}}/users/1",
                            "host": ["{{base_url}}"],
                            "path": ["users", "1"]
                        }
                    }
                },
                {
                    "name": "Delete User",
                    "request": {
                        "method": "DELETE",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/users/1",
                            "host": ["{{base_url}}"],
                            "path": ["users", "1"]
                        }
                    }
                }
            ]
        },
        {
            "name": "Posts",
            "item": [
                {
                    "name": "Get All Posts",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/posts",
                            "host": ["{{base_url}}"],
                            "path": ["posts"]
                        }
                    }
                },
                {
                    "name": "Create Post",
                    "request": {
                        "method": "POST",
                        "header": [
                            {
                                "key": "Content-Type",
                                "value": "application/json"
                            }
                        ],
                        "body": {
                            "mode": "raw",
                            "raw": "{\n    \"judul\": \"Artikel Baru\",\n    \"isi\": \"Isi artikel yang lengkap...\",\n    \"status\": \"published\",\n    \"kategori_id\": 1,\n    \"petugas_id\": 1\n}"
                        },
                        "url": {
                            "raw": "{{base_url}}/posts",
                            "host": ["{{base_url}}"],
                            "path": ["posts"]
                        }
                    }
                }
            ]
        },
        {
            "name": "Galeries",
            "item": [
                {
                    "name": "Get All Galeries",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/galeries",
                            "host": ["{{base_url}}"],
                            "path": ["galeries"]
                        }
                    }
                },
                {
                    "name": "Get Galeries by Category",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/galeries/category/pplg",
                            "host": ["{{base_url}}"],
                            "path": ["galeries", "category", "pplg"]
                        }
                    }
                }
            ]
        },
        {
            "name": "Utility",
            "item": [
                {
                    "name": "Database Stats",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/utility/database-stats",
                            "host": ["{{base_url}}"],
                            "path": ["utility", "database-stats"]
                        }
                    }
                },
                {
                    "name": "Search Posts",
                    "request": {
                        "method": "GET",
                        "header": [],
                        "url": {
                            "raw": "{{base_url}}/utility/search/posts?q=artikel&limit=5",
                            "host": ["{{base_url}}"],
                            "path": ["utility", "search", "posts"],
                            "query": [
                                {
                                    "key": "q",
                                    "value": "artikel"
                                },
                                {
                                    "key": "limit",
                                    "value": "5"
                                }
                            ]
                        }
                    }
                }
            ]
        }
    ]
}
```

---

## 🚀 GETTING STARTED

1. **Start your Laravel server:**
   ```bash
   php artisan serve
   ```

2. **Import the Postman collection above**

3. **Test the basic endpoints:**
   - `GET /api/users` - Get all users
   - `GET /api/posts` - Get all posts
   - `GET /api/utility/database-stats` - Get database statistics

4. **Create test data:**
   - Create a kategori first
   - Create a petugas
   - Create a post
   - Create a galery
   - Create fotos

---

## 📝 NOTES

- All endpoints return JSON responses
- Error responses include detailed error messages
- Validation errors return 422 status code
- Not found errors return 404 status code
- Server errors return 500 status code
- Successful operations return 200 status code
- Created resources return 201 status code

---

## 🔧 TROUBLESHOOTING

### Common Issues:

1. **404 Not Found:**
   - Check if Laravel server is running
   - Verify the API route exists
   - Check the URL path

2. **422 Validation Error:**
   - Check required fields in request body
   - Verify data types and formats
   - Check unique constraints

3. **500 Server Error:**
   - Check Laravel logs in `storage/logs/laravel.log`
   - Verify database connection
   - Check model relationships

### Testing Tips:

1. Start with GET requests to verify data exists
2. Use the database stats endpoint to check table counts
3. Test relationships with specialized endpoints
4. Use search functionality to find specific data
5. Test CRUD operations in order: Create → Read → Update → Delete
