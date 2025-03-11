Desain Basis Data Point of Sales (PoS) Sederhana:

tabel: m_supplier 
supplier_id (PK) int 
supplier_kode string(10) 
supplier_nama string(100) 
supplier_alamat string(255)

tabel: m_kategori 
kategori_id (PK) int 
kategori_kode string(10) 
kategori_nama string(100) 

tabel: m_level 
level_id (PK) int 
level_kode string(10) 
level_nama string(100) 

tabel: m_barang 
barang_id (PK) int 
kategori_id (FK) int 
barang_kode string(10) 
barang_nama string(100) 
harga_beli int 
harga_jual int 

tabel: t_penjualan 
penjualan_id (PK) int 
user_id (FK) int 
pembeli string(50) 
penjualan_kode string(20) 
penjualan_tanggal datetime 

tabel: m_user 
user_id (PK) int 
level_id (FK) int
username string(20) 
nama string(100) 
password string(255) 

tabel: t_penjualan_detail 
detail_id (PK) int 
penjualan_id (FK) int 
barang_id (FK) int 
harga int 
jumlah int 

tabel: t_stok 
stok_id (PK) int 
supplier_id (FK)
barang_id (FK) int
user_id (FK) int 
stok_tanggal datetime 
stok_jumlah int 