#!/usr/bin/env python3
"""
SCRIPT TESTING APLIKASI WISATA
Memeriksa:
1. Database connection
2. User Achmad Nuhan
3. Gambar URLs
4. Storage link
"""

import sqlite3
import os
import json
from pathlib import Path

# Tentukan path
PROJECT_PATH = r"C:\laragon\www\Projek-Pweb"
DB_PATH = os.path.join(PROJECT_PATH, "database", "database.sqlite")

def print_header(title):
    print(f"\n{'='*50}")
    print(f"  {title}")
    print(f"{'='*50}\n")
    
# Set encoding untuk Windows
import io
import sys
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

def check_database():
    """Cek database connection"""
    print_header("1️⃣  CHECKING DATABASE")
    
    if not os.path.exists(DB_PATH):
        print(f"❌ Database file tidak ditemukan: {DB_PATH}")
        return False
    
    try:
        conn = sqlite3.connect(DB_PATH)
        cursor = conn.cursor()
        
        # Cek tabel pengguna
        cursor.execute("SELECT COUNT(*) FROM pengguna")
        count = cursor.fetchone()[0]
        print(f"✅ Database connected!")
        print(f"   Total users: {count}")
        
        conn.close()
        return True
    except Exception as e:
        print(f"❌ Error: {e}")
        return False

def check_achmad_users():
    """Cek user Achmad Nuhan"""
    print_header("2️⃣  CHECKING ACHMAD NUHAN USERS")
    
    try:
        conn = sqlite3.connect(DB_PATH)
        conn.row_factory = sqlite3.Row
        cursor = conn.cursor()
        
        cursor.execute("""
            SELECT id_pengguna, nama_depan, nama_belakang, email, username, id_role 
            FROM pengguna 
            WHERE nama_depan = 'Achmad'
            ORDER BY id_pengguna
        """)
        
        users = cursor.fetchall()
        
        if not users:
            print("❌ TIDAK ADA USER ACHMAD!")
        else:
            print(f"✅ DITEMUKAN {len(users)} USER ACHMAD:\n")
            for i, user in enumerate(users, 1):
                role_map = {1: "Super Admin", 2: "Admin", 3: "Pemilik Wisata", 4: "Pengunjung"}
                print(f"   {i}. ID: {user['id_pengguna']}")
                print(f"      Nama: {user['nama_depan']} {user['nama_belakang']}")
                print(f"      Email: {user['email']}")
                print(f"      Username: {user['username']}")
                print(f"      Role: {role_map.get(user['id_role'], 'Unknown')}")
                print()
        
        conn.close()
        return True
    except Exception as e:
        print(f"❌ Error: {e}")
        return False

def check_storage():
    """Cek folder storage dan symlink"""
    print_header("3️⃣  CHECKING STORAGE")
    
    storage_link = os.path.join(PROJECT_PATH, "public", "storage")
    storage_app = os.path.join(PROJECT_PATH, "storage", "app", "public")
    
    print(f"Storage app path: {storage_app}")
    print(f"Public storage link: {storage_link}")
    
    if os.path.exists(storage_link):
        if os.path.islink(storage_link):
            print(f"✅ Symbolic link EXISTS")
            print(f"   Points to: {os.path.realpath(storage_link)}")
        else:
            print(f"✅ Storage folder EXISTS (not a symlink)")
    else:
        print(f"⚠️  Storage link does NOT exist - run: php artisan storage:link")
    
    if os.path.exists(storage_app):
        # Count files
        file_count = len([f for f in Path(storage_app).rglob("*") if f.is_file()])
        print(f"✅ Storage app/public folder EXISTS")
        print(f"   Files inside: {file_count}")
    else:
        print(f"⚠️  Storage app/public folder does NOT exist")

def check_gambar_tempat_wisata():
    """Cek gambar tempat wisata dari database"""
    print_header("4️⃣  CHECKING GAMBAR TEMPAT WISATA")
    
    try:
        conn = sqlite3.connect(DB_PATH)
        conn.row_factory = sqlite3.Row
        cursor = conn.cursor()
        
        cursor.execute("""
            SELECT gtw.*, tw.nama 
            FROM gambar_tempat_wisata gtw
            JOIN tempat_wisata tw ON gtw.id_tempat_wisata = tw.id_tempat_wisata
            LIMIT 5
        """)
        
        gambar = cursor.fetchall()
        
        if not gambar:
            print("⚠️  Tidak ada gambar tempat wisata")
        else:
            print(f"✅ Ditemukan gambar tempat wisata:\n")
            for img in gambar:
                print(f"   • {img['nama']}")
                print(f"     Path: {img['path_gambar']}")
                print()
        
        conn.close()
        return True
    except Exception as e:
        print(f"❌ Error: {e}")
        return False

def main():
    print("\n" + "="*50)
    print("  APLIKASI WISATA - TESTING SCRIPT")
    print("="*50)
    
    check_database()
    check_achmad_users()
    check_storage()
    check_gambar_tempat_wisata()
    
    print_header("✅ TESTING SELESAI")
    print("""
📝 NEXT STEPS:

1. Login dengan Achmad Nuhan:
   - Email: achmadnuhan@gmail.com (Super Admin)
   - Email: achmadnuhan.admin@gmail.com (Admin)
   - Email: achmadnuhan.visitor@gmail.com (Pengunjung)
   - Password: lihat database atau ubah di seeder

2. Run development server:
   composer run dev
   
   Atau manual:
   - Terminal 1: php artisan serve
   - Terminal 2: npm run dev
   - Terminal 3: php artisan queue:listen
   - Terminal 4: php artisan pail

3. Akses aplikasi:
   http://localhost:8000

4. Testing gambar:
   - Upload gambar di admin panel
   - Gambar akan tersimpan di: storage/app/public/
   - Akses via: /storage/nama-file.jpg
    """)

if __name__ == "__main__":
    main()
