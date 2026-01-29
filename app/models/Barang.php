<?php
namespace App\Models;

class Barang extends BaseModel
{
    protected string $table = 'barang';
    protected string $idColumn = 'id_barang';

    public function create(array $data): int
    {
        $this->query(
            "INSERT INTO {$this->table} (kode_barang, nama_barang, id_kategori, id_ruangan, merk, tahun_pengadaan, nilai_aset, status_barang, created_at)
             VALUES (:kode, :nama, :kat, :ruang, :merk, :tahun, :nilai, :status, NOW())",
            [
                'kode' => $data['kode_barang'],
                'nama' => $data['nama_barang'],
                'kat' => $data['id_kategori'],
                'ruang' => $data['id_ruangan'],
                'merk' => $data['merk'] ?? null,
                'tahun' => $data['tahun_pengadaan'] ?? null,
                'nilai' => $data['nilai_aset'] ?? null,
                'status' => $data['status_barang'] ?? 'baik',
            ]
        );
        return (int)$this->db->lastInsertId();
    }

    public function updateById(int $id, array $data): void
    {
        $this->query(
            "UPDATE {$this->table} SET
                kode_barang = :kode,
                nama_barang = :nama,
                id_kategori = :kat,
                id_ruangan = :ruang,
                merk = :merk,
                tahun_pengadaan = :tahun,
                nilai_aset = :nilai,
                status_barang = :status
             WHERE id_barang = :id",
            [
                'kode' => $data['kode_barang'],
                'nama' => $data['nama_barang'],
                'kat' => $data['id_kategori'],
                'ruang' => $data['id_ruangan'],
                'merk' => $data['merk'] ?? null,
                'tahun' => $data['tahun_pengadaan'] ?? null,
                'nilai' => $data['nilai_aset'] ?? null,
                'status' => $data['status_barang'] ?? 'baik',
                'id' => $id,
            ]
        );
    }
}
